<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="index")
     *
     */
    public function index(): Response
    {
        return $this->redirectToRoute('main');
    }


    /**
     * @Route("/main", name="main")
     * @param Request $request
     * @return Response
     */
    public function main(Request $request): Response
    {

        return $this->render('main/index.html.twig', [

        ]);
    }

    /**
     * @Route("/main/view", name="viewProduct")
     */
    public function viewProduct(): Response
    {
        return $this->render('main/view/index.html.twig', [

        ]);
    }

    /**
     * @Route("/main/store/{slug}", name="bookStore")
     */
    public function bookStore(): Response
    {
        return $this->render('main/books/index.html.twig', [

        ]);
    }


    /**
     * @Route("", name="searchResult")
     */
    public function searchResult(): Response
    {
        return $this->render('main/search/index.html.twig', [

        ]);
    }

    /**
     * @Route("", name="searchResult")
     * @return Response
     */
    public function userCart(): Response
    {

    }

}
