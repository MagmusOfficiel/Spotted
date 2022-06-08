<?php

namespace App\Controller\Admin;

use App\Entity\Reseaux;
use App\Form\ReseauxType;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReseauxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminReseauxController extends AbstractController
{
    #[Route("/admin/reseaux/", name: "admin_reseaux")]
    public function index(ReseauxRepository $repository): Response
    {
        $reseaux = $repository->findAll();
        return $this->render('admin/admin_reseaux/adminreseaux.html.twig', [
            'reseaux' => $reseaux,
        ]);
    }

    #[Route("/admin/reseaux/creation", name: "creationReseaux")]
    #[Route("/admin/reseaux/{id}", name: "modifReseaux")]
    public function modification(Reseaux $reseaux = null, Request $request, EntityManagerInterface $om)
    {
        if (!$reseaux) {
            $reseaux = new Reseaux();
        }

        $form = $this->createForm(ReseauxType::class, $reseaux);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reseaux->setreseauDestination("reseaux");
            $om->persist($reseaux);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_reseaux");
        }
        return $this->render('admin/admin_reseaux/modification.html.twig', [
            "reseaux" => $reseaux,
            "form" => $form->createView()
        ]);
    }

    #[Route("/admin/sup/reseaux/{id}", name: "supReseaux")]
    public function suppression(Reseaux $reseaux, Request $request, EntityManagerInterface $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $reseaux->getId(), $request->get("_token"))) {
            $om->remove($reseaux);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_reseaux");
        }

        return new Response('Condition non valide', 200);
    }
}
