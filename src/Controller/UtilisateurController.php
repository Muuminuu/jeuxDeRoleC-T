<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UtilisateurController extends AbstractController
{
    #[Route('/utilisateur/inscription', name: 'app_utilisateur_inscription')]
    public function inscription(Request $request): Response
    {
        $user = new User();
        // ...

        $form = $this->createForm(InscriptionType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $user = $form->getData();

            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('utilisateur/connexion.html.twig');
        }

        return $this->render('utilisateur/inscription.html.twig', [
            'formulaire' => $form->createView(),
        ]);
    }

    #[Route('/utilisateur/connexion', name: 'app_utilisateur_connexion')]
    public function connexion(): Response
    {
        return $this->render('utilisateur/connexion.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

}