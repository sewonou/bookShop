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
        /*dump($this->getUser());
        die();*/
        if($this->getUser() === null)
            return $this->redirectToRoute('main');
        if($this->getUser()->hasRole('ROLE_ADMIN'))
            return $this->redirect($this->generateUrl('admin'));

        elseif($this->getUser()->hasRole('ROLE_USER'))
            return $this->redirect($this->generateUrl('main'));
        elseif($this->getUser() === null)
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
     * @Route("", name="bookStore")
     */
    public function bookStore()
    {
        
    }

    /**
     * @Route("", name="searchResult")
     */
    public function searchResult()
    {

    }
}
