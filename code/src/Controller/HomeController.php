<?php

namespace App\Controller;

use App\Entity\Character\Region;
use App\Provider\RegionProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private RegionProvider $regionProvider;

    public function __construct(
        RegionProvider $regionProvider
    )
    {
    $this->regionProvider = $regionProvider;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $api = $this->regionProvider->getRegionData();

        $region = new Region();
        $region->setName($api['name'])
            ->setTag($api['tag'])
            ->setWowId($api['id'])
            ->setRequestUrl($api['_links']['self']['href']);


        return $this->render('base.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
