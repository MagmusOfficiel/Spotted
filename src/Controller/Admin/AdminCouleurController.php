<?php

namespace App\Controller\Admin;

use App\Entity\Couleur;
use App\Form\CouleurType;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CouleurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCouleurController extends AbstractController
{
    #[Route("/admin/couleurs/", name:"admin_couleurs")]
    public function index(CouleurRepository $repository): Response
    {
        $couleurs = $repository->findAll();

        return $this->render('admin/admin_couleurs/admincouleurs.html.twig', [
            'couleurs' => $couleurs
        ]);
    }

    #[Route("/admin/couleurs/creation", name:"creationCouleur")]
    #[Route("/admin/couleurs/{id}", name:"modifCouleur")]
    public function modification(Couleur $couleur = null, Request $request, EntityManagerInterface $om)
    {
        if (!$couleur) {
            $couleur = new Couleur();
        }

        $form = $this->createForm(CouleurType::class, $couleur);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $om->persist($couleur);
            $om->flush();

            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_couleurs");
        }
        return $this->render('admin/admin_couleurs/modification.html.twig', [
            "couleur" => $couleur,
            "form" => $form->createView()
        ]);
    }

    #[Route("/admin/sup/couleurs/{id}", name:"supCouleur")]
    public function suppression(Couleur $couleur, Request $request, EntityManagerInterface $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $couleur->getId(), $request->get("_token"))) {
            $om->remove($couleur);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_couleurs");
        }
    }
}
