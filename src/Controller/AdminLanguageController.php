<?php

namespace App\Controller;

use App\Entity\Language;
use App\Form\LanguageType;
use App\Repository\LanguageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminLanguageController extends AbstractController
{
    /**
     * @Route("/admin/language", name="admin_language")
     * @param LanguageRepository $repository
     * @return Response
     */
    public function index(LanguageRepository $repository): Response
    {
        return $this->render('admin/language/index.html.twig', [
            'languages' => $repository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/language/create", name="admin_language_add")
     * @param EntityManagerInterface $manager
     * @param Request $request
     * @return Response
     */
    public function create(EntityManagerInterface $manager, Request $request): Response
    {
        $language = new Language();
        $form = $this->createForm(LanguageType::class, $language);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash('success', "La langue <strong>{$language->getName()}</strong> a bien été ajouter");
            $language->setSlug($language->initializeSlug());
            $manager->persist($language);

            $manager->flush();
            return  $this->redirectToRoute('admin_language');
        }
        return $this->render('admin/language/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/language/{id}/edit", name="admin_language_edit")
     * @param EntityManagerInterface $manager
     * @param Request $request
     * @param Language $language
     * @return Response
     */
    public function edit(EntityManagerInterface $manager, Request $request, Language $language): Response
    {

        $form = $this->createForm(LanguageType::class, $language);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash('success', "La langue <strong>{$language->getName()}</strong> a bien été modifier");
            $language->setSlug($language->initializeSlug());
            $manager->persist($language);

            $manager->flush();
            return  $this->redirectToRoute('admin_language');
        }
        return $this->render('admin/language/edit.html.twig', [

        ]);
    }

    /**
     * @Route("/admin/language/{id}/delete", name="admin_language_delete")
     * @param Language $language
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Language $language, EntityManagerInterface $manager): Response
    {
        $this->addFlash('success', "La langue <strong>{$language->getName()}</strong> a bien été supprimer");
        $manager->remove($language);
        $manager->flush();
        return $this->redirectToRoute('admin_language', [

        ]);
    }
}
