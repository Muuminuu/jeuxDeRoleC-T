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
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UtilisateurController extends AbstractController
{
    // #[Route('/utilisateur/inscription', name: 'app_utilisateur_inscription')]
    // public function index(UserPasswordHasherInterface $passwordHasher): Response
    // {
    //     // ... e.g. get the user data from a registration form
    //     $user = new User();
    //     $plaintextPassword = $user->setPassword('plaintextPassword');

    //     // hash the password (based on the security.yaml config for the $user class)
    //     $hashedPassword = $passwordHasher->hashPassword(
    //         $user,
    //         $plaintextPassword
    //     );
    //     $user->setPassword($hashedPassword);
    // }
    #[Route('/utilisateur/inscription', name: 'app_utilisateur_inscription')]
    public function inscription(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $user->setLevel('1');
        $user->setCreatedAt(new \DateTimeImmutable());
    
        $form = $this->createForm(InscriptionType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $user = $form->getData();
            $plaintextPassword = $user->getPassword('plaintextPassword');
            // ...
    
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);

            $manager->persist($user);
            $manager->flush();

            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('app_utilisateur_connexion');
        }

        return $this->render('utilisateur/inscription.html.twig', [
            'formulaire' => $form->createView(),
        ]);
    }

    #[Route(path: '/utilisateur/connexion', name: 'app_utilisateur_connexion')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('utilisateur/connexion.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }


    #[Route(path: '/deconnexion', name: 'app_deconnexion')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    // #[Route('/utilisateur/connexion', name: 'app_utilisateur_connexion')]
    // public function connexion(): Response
    // {
    //     return $this->render('utilisateur/connexion.html.twig', [
    //         'controller_name' => 'UtilisateurController',
    //     ]);
    // }

}