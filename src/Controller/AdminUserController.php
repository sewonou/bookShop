<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminUserController extends AbstractController
{
    /**
     * @Route("/admin/user", name="admin_user")
     * @param UserRepository $repository
     * @return Response
     */
    public function index(UserRepository $repository): Response
    {

        return $this->render('admin/user/index.html.twig', [
            'users' => $repository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/user/create", name="admin_user_add")
     * @param EntityManagerInterface $manager
     * @param UserPasswordEncoderInterface $encoder
     * @param Request $request
     * @return Response
     */
    public function create(EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder, Request $request):Response
    {
        $user=new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $password = $user->getPassword();
            $password = $encoder->encodePassword($user, $password);
            $user->setHash($password);
            $this->addFlash('success', "L'utilisateur <strong>{$user->getLogin()}</strong> a bien été ajouter");
            $manager->persist($user);
            $manager->flush();
            return  $this->redirectToRoute('admin_user');
        }
        return $this->render('admin/user/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/user/{id}/edit", name="admin_user_edit")
     * @param User $user
     * @param EntityManagerInterface $manager
     * @param UserPasswordEncoderInterface $encoder
     * @param Request $request
     * @return Response
     */
    public function edit(User $user, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder,  Request $request) :Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $password = $user->getPassword();
            $password = $encoder->encodePassword($user, $password);
            $user->setHash($password);
            $this->addFlash('success', "L'utilisateur <strong>{$user->getLogin()}</strong> a bien été ajouter");
            $manager->persist($user);
            $manager->flush();
            return  $this->redirectToRoute('admin_user');
        }
        return $this->render('admin/user/edit.html.twig', [
            'user'=> $user,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/user/{id}/delete", name="admin_user_delete")
     * @param User $user
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(User $user, EntityManagerInterface $manager) :Response
    {
        $this->addFlash('success', "L'utilisateur <strong>{$user->getLogin()}</strong> a bien été supprimer");
        $manager->remove($user);
        $manager->flush();
        return  $this->redirectToRoute("admin_user");
    }
}
