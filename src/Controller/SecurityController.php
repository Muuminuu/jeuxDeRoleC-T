<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/connexion', name: 'app_security.connexion', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('pages/security/connexion.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    #[Route(path: '/deconnexion', name: 'app_security.deconnexion')]
    public function logout(): void
    {
    
    }

    #[Route('/inscription', name: 'app_security.inscription')]
    public function inscription(Request $request, EntityManagerInterface $manager): Response
    {
        $user = new User();
        
        $form = $this->createForm(InscriptionType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $this->addFlash(
                'success',
                'Votre compte a bien été crée.'
            );
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('app_security.connexion');
        }

        return $this->render('pages/security/inscription.html.twig', [
            'formulaire' => $form->createView(),
        ]);
    }
}
