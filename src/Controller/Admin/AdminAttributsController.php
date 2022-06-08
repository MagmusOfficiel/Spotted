<?php

namespace App\Controller\Admin;

use App\Entity\Attributs;
use App\Form\AttributsType;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AttributsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAttributsController extends AbstractController
{
    #[Route("/admin/attributs/", name:"admin_attributs")]
    public function index(AttributsRepository $repository): Response
    {
        $attributs = $repository->findAll();

        return $this->render('admin/admin_attributs/adminattributs.html.twig', [
            'attributs' => $attributs
        ]);
    }

    #[Route("/admin/attributs/creation", name:"creationAttribut")]
    #[Route("/admin/attributs/{id}", name:"modifAttribut")]
    public function modification(Attributs $attributs = null, Request $request, EntityManagerInterface $om)
    {
        if (!$attributs) {
            $attributs = new Attributs();
        }

        $form = $this->createForm(AttributsType::class, $attributs);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $om->persist($attributs);
            $om->flush();

            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_attributs");
        }
        return $this->render('admin/admin_attributs/modification.html.twig', [
            "attributs" => $attributs,
            "form" => $form->createView()
        ]);
    }

    #[Route("/admin/sup/attributs/{id}", name:"supAttributs")]
    public function suppression(Attributs $attributs, Request $request, EntityManagerInterface $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $attributs->getId(), $request->get("_token"))) {
            $om->remove($attributs);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_attributs");
        }

        return new Response('Condition non valide', 200);
    }
}
