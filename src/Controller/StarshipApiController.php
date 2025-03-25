<?php

namespace App\Controller;

use App\Model\Starship;
use App\Repository\StarshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StarshipApiController extends AbstractController
{
     #[Route('/api/starships', name: 'starship')]
    public function getCollection(StarshipRepository $repository):Response
    {
        $starships =$repository->findAll();
        return $this->json($starships);

    }

}