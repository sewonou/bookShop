<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryController extends AbstractController
{
    /**
     * @Route("/admin/category", name="admin_category")
     * @param CategoryRepository $repository
     * @return Response
     */
    public function index(CategoryRepository $repository): Response
    {

        return $this->render('admin/category/index.html.twig', [
            'categories' => $repository->findAll()
        ]);
    }

    /**
     * @Route("/admin/category/create", name="admin_category_add")
     * @param EntityManagerInterface $manager
     * @param Request $request
     * @return Response
     */
    public function create(EntityManagerInterface $manager, Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash('success', "La catégorie <strong>{$category->getName()}</strong> a bien été ajouter");
            $category->setSlug($category->initializeSlug());
            $manager->persist($category);

            $manager->flush();
            return  $this->redirectToRoute('admin_category');
        }

        return $this->render('admin/category/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/category/{id}/edit", name="admin_category_edit")
     * @param EntityManagerInterface $manager
     * @param Request $request
     * @param Category $category
     * @return Response
     */
    public function edit(EntityManagerInterface $manager, Request $request, Category $category): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash('success', "La catégorie <strong>{$category->getName()}</strong> a bien été modifier");
            $category->setSlug($category->initializeSlug());
            $manager->persist($category);
            $manager->flush();
            return  $this->redirectToRoute('admin_category');
        }
        return $this->render('admin/category/edit.html.twig', [
            'form' => $form->createView(),
            'category' => $category,
        ]);
    }

    /**
     * @Route("/admin/category/{id}/delete", name="admin_category_delete")
     * @param EntityManagerInterface $manager
     * @param Request $request
     * @param Category $category
     * @return Response
     */
    public function delete(EntityManagerInterface $manager, Request $request, Category $category): Response
    {
        $this->addFlash('success', "L'utilisateur <strong>{$category->getName()}</strong> a bien été supprimer");
        $manager->remove($category);
        $manager->flush();
        return $this->redirectToRoute('admin_category');
    }
}
