<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Form\CategorieType;
use Symfony\Component\Routing\Route;
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
    public function modification(Categories $categorie = null, Request $request, EntityManagerInterface $om)
    {
        if (!$categorie) {
            $categorie = new Categories();
        }

        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $om->persist($categorie);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_categories");
        }

        return $this->render('admin/admin_categories/modification.html.twig', [
            "categorie" => $categorie,
            "form" => $form->createView()
        ]);
    }

    #[Route("/admin/sup/categories/{id}", name: "supCategorie")]
    public function suppression(Categories $categorie, Request $request, EntityManagerInterface $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $categorie->getId(), $request->get("_token"))) {
            $om->remove($categorie);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_categories");
        }

        return new Response('Condition non valide', 200);
    }


    #[Route("/admin/souscategories/{id}", name: "sousCategories")]
    public function fetchSousCategories(Categories $categorie, CategoriesRepository $repository, SousCategoriesRepository $repository2): Response
    {
        $souscategories = $repository2->findAll();
        $categorieid = $categorie->getId();
        $categorie = $repository->findBy([
            'id' => $categorieid // On passe l'id du produit
        ]);
        return $this->render('admin/admin_sous_categories/adminsouscategories.html.twig', [
            'categorie' => $categorie,
            'souscategories' => $souscategories,
        ]);
    }
}
