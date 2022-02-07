<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AccountController extends AbstractController
{
    /**
     * @Route("/main/account", name="account")
     */
    public function index(): Response
    {
        return $this->render('main/account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    /**
     * @Route("/main/login", name="account_login")
     */
    public function login(AuthenticationUtils $utils): Response
    {
        $errors  = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();
        return $this->render('main/account/login.html.twig', [
            'hasError' => $errors !== null,
            'username' => $username,

        ]);
    }
    /**
     * @Route("/main/logout", name="account_logout")
     */
    public function logout(): Response
    {
        return $this->render('main/account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
}
