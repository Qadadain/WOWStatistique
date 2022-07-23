<?php

namespace App\Controller;

use App\Entity\Character\Region;
use App\Provider\RegionProvider;
use App\Repository\RegionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private RegionProvider $regionProvider;

    public function __construct(
        RegionProvider $regionProvider,
        private  readonly EntityManagerInterface $entityManager,
        private  readonly RegionRepository $regionRepository,
    )
    {
    $this->regionProvider = $regionProvider;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {

        $api = $this->regionProvider->getRegionData();

        $region = new Region(
            name: $api['name'],
            tag: $api['tag'],
            wowId: $api['id'],
            requestUrl: $api['_links']['self']['href']
        );

        $regions = $this->regionRepository->findAll();
        foreach ($regions as $data) {
            $this->entityManager->remove($data);
        }
        $this->entityManager->persist($region);
        $this->entityManager->flush();


        return $this->render('base.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
