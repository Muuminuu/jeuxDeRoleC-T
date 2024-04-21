<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CodexController extends AbstractController
{
    #[Route('/codex/bestiaire', name: 'app_codex_bestiaire')]
    public function bestiaire(): Response
    {
        return $this->render('codex/bestiaire.html.twig', [
            'controller_name' => 'CodexController',
        ]);
    }

    #[Route('/codex/armes', name: 'app_codex_armes')]
    public function armes(): Response
    {
        return $this->render('codex/armes.html.twig', [
            'controller_name' => 'CodexController',
        ]);
    }

    #[Route('/codex/personnages', name: 'app_codex_personnages')]
    public function personnages(): Response
    {
        return $this->render('codex/personnages.html.twig', [
            'controller_name' => 'CodexController',
        ]);
    }
}
