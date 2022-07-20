Common commands:

```bash
docker compose up -d # build containers if never run before and run the project (--build to rebuild)

docker compose exec web npm ci # install node modules
docker compose exec web composer install # install php dependencies

docker compose exec web php bin/console cache:clear # clear symfony's cache
docker compose exec web php bin/console doctrine:migration:migrate --no-interaction # migrate database

docker compose exec web npm run watch # regenerates assets during development (will not release the terminal)
docker compose exec web npm run build # generates assets as done for the production

docker compose exec web vendor/bin/php-cs-fixer fix # fix php code style

docker compose exec web vendor/bin/phpstan analyse
```

You can also fix javascript files code style with the following commands (node required):

```bash
docker compose exec web npm ci
docker compose exec web node_modules/.bin/eslint . # for the js, please watch out for the dot, won't work if missing
docker compose exec web node_modules/.bin/stylelint "**/*.scss" # for the scss 
```