<?php

namespace App\Controller\Admin;
 
use App\Entity\SousSousCategories;
use App\Form\SousSousCategorieType;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use App\Repository\SousSousCategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminSousSousCategoriesController extends AbstractController
{
    #[Route("/admin/soussouscategorie/", name:"admin_sousouscategorie")]
    public function index(SousSousCategoriesRepository $repository): Response
    {
        $soussouscategories = $repository->findAll();
        return $this->render('admin/admin_sous_sous_categories/adminsoussouscategories.html.twig', [
            'soussouscategories' => $soussouscategories
        ]);
    }

    #[Route("/admin/soussouscategorie/creation", name:"creationSousSousCategorie")]
    #[Route("/admin/soussouscategorie/{id}", name:"modifSousSousCategorie")]
    public function modification(SousSousCategories $soussouscategories = null, Request $request, EntityManagerInterface $om)
    {
        if (!$soussouscategories) {
            $soussouscategories = new SousSousCategories();
        }

        $form = $this->createForm(SousSousCategorieType::class, $soussouscategories);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $om->persist($soussouscategories);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_categories");
        }

        return $this->render('admin/admin_sous_sous_categories/modification.html.twig', [
            "soussouscategories" => $soussouscategories,
            "form" => $form->createView()
        ]);
    }

    #[Route("/admin/sup/soussouscategorie/{id}", name:"supSousSousCategorie")]
    public function suppression(SousSousCategories $soussouscategories, Request $request, EntityManagerInterface $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $soussouscategories->getId(), $request->get("_token"))) {
            $om->remove($soussouscategories);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_categories");
        }

        return new Response('Condition non valide', 200);
    }

    #[Route("/admin/supall/soussouscategorie/{id}", name:"supAllSousSousCategorie")]
    public function deleteAllEmployees(SousSousCategoriesRepository $repository,Request $request) {
        
        $souscategorieid = $request->get('id');
        $souscategorie = $repository->findBy([
            'id' => $souscategorieid // On passe l'id du produit
        ]);
        return $this->redirectToRoute("admin_categories");
    }
}
