<?php

namespace App\Controller\Admin;

use App\Entity\Transporteur;
use App\Form\TransporteurType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TransporteurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminTransporteurController extends AbstractController
{
    #[Route("/admin/transporteur/", name:"admin_transporteur")]
    public function index(TransporteurRepository $repository): Response
    {
        $transporteurs = $repository->findAll();

        return $this->render('admin/admin_transporteur/admintransporteur.html.twig', [
            'transporteurs' => $transporteurs
        ]);
    }


    #[Route("/admin/transporteur/creation", name:"creationTransporteur")]
    #[Route("/admin/transporteur/{id}", name:"modifTransporteur")]
    public function modification(Transporteur $transporteur = null, Request $request, EntityManagerInterface $om)
    {
        if (!$transporteur) {
            $transporteur = new Transporteur();
        }

        $form = $this->createForm(TransporteurType::class, $transporteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $om->persist($transporteur);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_transporteur");
        }
        return $this->render('admin/admin_transporteur/modification.html.twig', [
            "transporteur" => $transporteur,
            "form" => $form->createView()
        ]);
    }

    #[Route("/admin/sup/transporteur/{id}", name:"supTransporteur")]
    public function suppression(Transporteur $transporteur, Request $request, EntityManagerInterface $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $transporteur->getId(), $request->get("_token"))) {
            $om->remove($transporteur);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_transporteur");
        }

        return new Response('Condition non valide', 200);
    }
}
