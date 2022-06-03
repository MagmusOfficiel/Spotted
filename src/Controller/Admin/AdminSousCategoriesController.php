<?php

namespace App\Controller\Admin;

use App\Entity\SousCategories;
use App\Form\SousCategoriesType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\SousCategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SousSousCategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminSousCategoriesController extends AbstractController
{
    /**
     * @Route("/admin/souscategorie/", name="admin_souscategorie")
     */
    public function index(SousCategoriesRepository $repository): Response
    {
        $souscategories = $repository->findAll();
        return $this->render('admin/admin_sous_categories/adminsouscategories.html.twig', [
            'souscategories' => $souscategories
        ]);
    }

    /**
     * @Route("/admin/souscategorie/creation", name="creationSousCategorie")
     * @Route("/admin/souscategorie/{id}", name="modifSousCategorie")
     */
    public function modification(SousCategories $souscategories = null, Request $request, EntityManagerInterface $om)
    {
        if (!$souscategories) {
            $souscategories = new SousCategories();
        }

        $form = $this->createForm(SousCategoriesType::class, $souscategories);
        $form->handleRequest($request); 
        if ($form->isSubmitted() && $form->isValid()) {
            $om->persist($souscategories);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_categories");
        }

        return $this->render('admin/admin_sous_categories/modification.html.twig', [
            "souscategories" => $souscategories,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/sup/souscategorie/{id}", name="supSousCategorie")
     */
    public function suppression(SousCategories $souscategories, Request $request, EntityManagerInterface $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $souscategories->getId(), $request->get("_token"))) {
            $om->remove($souscategories);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_souscategorie");
        }

        return new Response('Condition non valide', 200);
    }

        /**
     * 
     * @Route("/admin/soussouscategories/{id}", name="sousSousCategories")
     */
    public function fetchSousSousCategories(SousCategories $souscategorie, SousCategoriesRepository $repository,SousSousCategoriesRepository $repository2): Response
    {
        $soussouscategories = $repository2->findAll();
        $souscategorieid = $souscategorie->getId();
        $souscategorie = $repository->findBy([
            'id' => $souscategorieid // On passe l'id du produit
        ]);
        return $this->render('admin/admin_sous_sous_categories/adminsoussouscategories.html.twig', [
            'souscategorie' => $souscategorie,
            'soussouscategories' => $soussouscategories,
        ]);
    }

}
