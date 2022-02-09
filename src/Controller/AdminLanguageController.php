<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminLanguageController extends AbstractController
{
    /**
     * @Route("/admin/language", name="admin_language")
     */
    public function index(): Response
    {
        return $this->render('admin_language/index.html.twig', [
            'controller_name' => 'AdminLanguageController',
        ]);
    }
}
