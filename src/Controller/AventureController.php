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
        return $this->render('pages/aventure/index.html.twig', [
            'controller_name' => 'AventureController',
        ]);
    }

    #[Route('/aventure/prologue', name: 'app_aventure_prologue', methods: ['GET'])]
    public function prologue(): Response
    {
        return $this->render('pages/aventure/prologue.html.twig', [
            'controller_name' => 'AventureController',
        ]);
    }

    #[Route('/aventure/acteun', name: 'app_aventure_acteun', methods: ['GET'])]
    public function acteUn(): Response
    {
        return $this->render('pages/aventure/acteun.html.twig', [
            'controller_name' => 'AventureController',
        ]);
    }

}
