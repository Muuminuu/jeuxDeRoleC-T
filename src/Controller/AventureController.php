<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AventureController extends AbstractController
{
    #[Route('/aventure', name: 'app_aventure', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('aventure/index.html.twig', [
            'controller_name' => 'AventureController',
        ]);
    }
}
