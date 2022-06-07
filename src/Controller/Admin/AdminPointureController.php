<?php

namespace App\Controller\Admin;

use App\Entity\Pointure;
use App\Form\PointureType;
use Symfony\Component\Routing\Route;
use App\Repository\PointureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPointureController extends AbstractController
{
    #[Route("/admin/pointures/", name: "admin_pointures")]
    public function index(PointureRepository $repository): Response
    {
        $pointures = $repository->findAll();

        return $this->render('admin/admin_pointures/adminpointures.html.twig', [
            'pointures' => $pointures
        ]);
    }

    #[Route("/admin/pointures/creation", name: "creationPointure")]
    #[Route("/admin/pointures/{id}", name: "modifPointure")]
    public function modification(Pointure $pointure = null, Request $request, EntityManagerInterface $om)
    {
        if (!$pointure) {
            $pointure = new Pointure();
        }
        $form = $this->createForm(PointureType::class, $pointure);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $om->persist($pointure);
            $om->flush();

            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_pointures");
        }
        return $this->render('admin/admin_pointures/modification.html.twig', [
            "pointure" => $pointure,
            "form" => $form->createView()
        ]);
    }

    #[Route("/admin/sup/pointures/{id}", name: "supPointure")]
    public function suppression(Pointure $pointure, Request $request, EntityManagerInterface $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $pointure->getId(), $request->get("_token"))) {
            $om->remove($pointure);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_pointures");
        }
    }
}
