<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Form\CategorieType;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\SousCategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCategoriesController extends AbstractController
{
    #[Route("/admin/categories/", name: "admin_categories")]
    public function index(CategoriesRepository $repository): Response
    {
        $categories = $repository->findAll();
        return $this->render('admin/admin_categories/admincategories.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route("/admin/categories/creation", name: "creationCategorie")]
    #[Route("/admin/categories/{id}", name: "modifCategorie")]
    public function modification(Categories $categories = null, Request $request, EntityManagerInterface $om)
    {
        if (!$categories) {
            $categories = new Categories();
        }

        $form = $this->createForm(CategorieType::class, $categories);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $om->persist($categories);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_categories");
        }

        return $this->render('admin/admin_categories/modification.html.twig', [
            "categories" => $categories,
            "form" => $form->createView()
        ]);
    }

    #[Route("/admin/sup/categories/{id}", name: "supCategorie")]
    public function suppression(Categories $categories, Request $request, EntityManagerInterface $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $categories->getId(), $request->get("_token"))) {
            $om->remove($categories);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_categories");
        }

        return new Response('Condition non valide', 200);
    }


    #[Route("/admin/souscategories/{id}", name: "sousCategories")]
    public function fetchSousCategories(Categories $categories, CategoriesRepository $repository, SousCategoriesRepository $repository2): Response
    {
        $souscategories = $repository2->findAll();
        $categorieid = $categories->getId();
        $categories = $repository->findBy([
            'id' => $categorieid // On passe l'id du produit
        ]);
        return $this->render('admin/admin_sous_categories/adminsouscategories.html.twig', [
            'categories' => $categories,
            'souscategories' => $souscategories,
        ]);
    }
}
