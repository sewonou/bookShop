<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @return Response
     */
    public function create(EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder):Response
    {
        $user=new User();
        $form = $this->createForm(UserType::class, $user);
        return $this->render('admin/user/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/user/{id}/edit", name="admin_user_edit")
     * @param EntityManagerInterface $manager
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function edit(EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder) :Response
    {
        return $this->render('admin/user/edit.html.twig', [

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
        $this->addFlash('success', "L'utilisateur <strong>{$user->getFullName()}</strong> a bien été supprimer");
        $manager->remove($user);
        $manager->flush();
        return  $this->redirectToRoute("admin_user");
    }
}
