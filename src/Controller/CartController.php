<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/main/cart", name="cart")
     */
    public function index(): Response
    {
        return $this->render('/main/cart/index.html.twig', [

        ]);
    }
}
