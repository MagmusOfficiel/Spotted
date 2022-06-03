<?php

namespace App\Controller\Admin;

use App\Entity\Marque;
use App\Entity\Produit;
use App\Form\MarqueType;
use App\Repository\MarqueRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminMarquesController extends AbstractController
{
    /**
     * @Route("/admin/marques/", name="admin_marques")
     */
    public function index(MarqueRepository $repository): Response
    {
        $marques = $repository->findAll();

        return $this->render('admin/admin_marques/adminmarques.html.twig', [
            'marques' => $marques
        ]);
    }


    /**
     * @Route("/admin/marques/creation", name="creationMarque")
     * @Route("/admin/marques/{id}", name="modifMarque")
     */
    public function modification(Marque $marque = null, Request $request, EntityManagerInterface $om)
    {
        if (!$marque) {
            $marque = new Marque();
        }

        $form = $this->createForm(MarqueType::class, $marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $destination = $marque->getMarqueNom();
            $marque->setmarqueDestination(strtolower($destination));
            $om->persist($marque);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_marques");
        }
        return $this->render('admin/admin_marques/modification.html.twig', [
            "marque" => $marque,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/sup/marques/{id}", name="supMarque")
     */
    public function suppression(Marque $marque, Request $request, EntityManagerInterface $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $marque->getId(), $request->get("_token"))) {
            $om->remove($marque);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_marques");
        }

        return new Response('Condition non valide', 200);
    }
}
