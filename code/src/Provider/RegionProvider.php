<?php
declare(strict_types=1);

namespace App\Provider;


use App\Entity\Character\Region;
use Doctrine\Common\Collections\ArrayCollection;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class RegionProvider
{
    public function __construct(
        private readonly HttpClientInterface $wowApi,
        private readonly LoggerInterface $logger,
        private readonly SerializerInterface $serializer,
        private readonly string $wowApiLocale,
    ) {
    }

    public function getRegionData()
    {
        try {
            $response = $this->wowApi->request(
                method: Request::METHOD_GET,
                url: 'region/3',
                options: [
                    'query' => [
                        'region' => 'EU',
                        'namespace' => 'dynamic-eu',
                        'locale' => $this->wowApiLocale,
                        'access_token' => 'USe2VuJpA76U7MIHgU0nfiQWcwaEEQBA05',
                    ]
                ]
            )->toArray();
            dd($response);
        } catch (\Throwable $exception) {
            $this->logger->error('Unable to retrieve advice articles from the api', [
                'message' => $exception->getMessage(),
            ]);

            return new ArrayCollection();
        }

        return $response;
    }
}