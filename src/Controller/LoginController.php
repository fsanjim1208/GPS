<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;

class LoginController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): Response
    {
        return $this->render('main/home.html.twig');
    }

    #[Route('/setAdmin', name: 'app_setAdmin')]
    public function admin(): Response
    {
        $entityManager = $this->doctrine->getManager();
        $user = $entityManager->getRepository(User::class)->find(2);
        
        $user->setRoles(['ROLE_ADMIN']);
        
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->render('main/home.html.twig');
    }
}
