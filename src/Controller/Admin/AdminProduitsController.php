<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminProduitsController extends AbstractController
{
    /**
     * @Route("/admin/produits/", name="admin_produits")
     */
    public function index(ProduitRepository $repository): Response
    {
        $produits = $repository->findall();
        return $this->render('admin/admin_produits/adminproduit.html.twig', [
            'produits' => $produits
        ]);
    }

    /**
     * @Route("/admin/creation/produit", name="creationProduit", methods={"GET","POST"})
     * @Route("/admin/produit/{id}", name="modifProduit")
     */
    public function modification(Produit $produit = null, Request $request, EntityManagerInterface $om)
    {
        if (!$produit) {
            $produit = new Produit();
        }

        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {  
            foreach ( $produit->getProduitImages() as $productImg ) {
                $productImg->setProduit($produit);
            }
            $date=  new \DateTime('now');
            $produit->setProduitCreation($date);
            $om->persist($produit);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute('admin_produits');
        }
        return $this->render('admin/admin_produits/modification.html.twig', [
            "produit" => $produit,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/sup/produit/{id}", name="supProduit")
     */
    public function suppression(Produit $produit, Request $request, EntityManagerInterface $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $produit->getId(), $request->get("_token"))) {
            $om->remove($produit);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_produits");
        }

        return new Response('Condition non valide', 200);
    }

            /**
     * @Route("/admin/produit/addbloque/{id}", name="caddBloque")
     */
    public function addBloque(Produit $produit, EntityManagerInterface $om)
    {
        $bloque = $produit->getProduitBloque();

        if($bloque == '0') {
            $bloque++;
        } else {
            $bloque--;
        }   
        $produit->setProduitBloque($bloque);
        $om->persist($produit);
        $om->flush();
        $this->addFlash('success', "L'action a été effectué");
        return $this->redirectToRoute("admin_produits");
    }
}
