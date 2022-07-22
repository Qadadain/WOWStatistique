FROM php:8.1.2-fpm-alpine AS base

ENV APP_ENV prod

RUN apk add --update --no-cache zip libzip-dev icu-dev \
 && docker-php-ext-configure zip \
 && docker-php-ext-install zip intl opcache pdo pdo_mysql \
 && rm -rf /var/www/html/

########################################################################################################################

FROM base AS composer

RUN apk add --no-cache --update curl git libzip-dev openssl unzip zip \
 && docker-php-ext-install zip \
 && mkdir /composer

COPY /code/composer.json /composer
COPY /code/composer.lock /composer
COPY /code/symfony.lock /composer

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

RUN composer install --working-dir=/composer --no-dev --no-autoloader --no-progress --no-scripts --no-interaction

COPY /code /var/www/html/
RUN mv /composer/vendor /var/www/html/vendor \
 && composer dump-autoload --working-dir=/var/www/html/ --optimize --classmap-authoritative --no-interaction \
 && php /var/www/html/bin/console cache:clear

########################################################################################################################

FROM node:17-alpine3.14 AS npm

WORKDIR /code
ENV NODE_ENV development

COPY /code/package.json /code
COPY /code/package-lock.json /code
RUN npm ci

COPY /code/assets /code/assets
COPY /code/postcss.config.js /code
COPY /code/tailwind.config.js /code
COPY /code/webpack.config.js /code
RUN npm run build

########################################################################################################################

FROM base AS final

RUN apk add --no-cache --update nginx \
 && docker-php-ext-enable opcache

COPY ./deploy/local.ini /usr/local/etc/php/conf.d/local.ini
COPY ./deploy/conf.d/nginx.conf /etc/nginx/http.d/default.conf

COPY --from=composer --chown=nginx /var/www/html /var/www/html
COPY --from=npm --chown=nginx /code/public/build /var/www/html/public/build

RUN chown nginx -R /var/www/html

EXPOSE 8080
RUN nginx -t

COPY /post_deploy.sh /post_deploy.sh

RUN ["chmod", "+x", "/post_deploy.sh"]

CMD [ "sh", "/post_deploy.sh" ]

########################################################################################################################

FROM final as dev

ENV APP_ENV=dev

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

RUN apk add --no-cache --update npm
