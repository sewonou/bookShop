<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminAccountController extends AbstractController
{
    /**
     * @Route("/admin/account", name="admin_account")
     */
    public function index(): Response
    {
        return $this->render('admin_account/index.html.twig', [
            'controller_name' => 'AdminAccountController',
        ]);
    }

    /**
     * @Route("/admin/login", name="admin_account_login")
     * @param AuthenticationUtils $utils
     * @return Response
     */
    public function login(AuthenticationUtils $utils): Response
    {
        $errors  = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();
        return $this->render('admin_account/login.html.twig', [
            'controller_name' => 'AdminAccountController',
            'hasError' => $errors !== null,
            'username' => $username,
        ]);
    }
    /**
     * @Route("/admin/logout", name="admin_account_logout")
     */
    public function logout(): Response
    {
        return $this->render('admin_account/index.html.twig', [
            'controller_name' => 'AdminAccountController',
        ]);
    }
}
