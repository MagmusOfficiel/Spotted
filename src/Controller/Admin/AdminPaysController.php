<?php

namespace App\Controller\Admin;

use App\Entity\Pays;
use App\Form\PaysType;
use App\Repository\PaysRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPaysController extends AbstractController
{
    #[Route("/admin/pays/", name:"admin_pays")]
    public function index(PaysRepository $repository): Response
    {
        $pays = $repository->findAll();

        return $this->render('admin/admin_pays/adminpays.html.twig', [
            'pays' => $pays
        ]);
    }


    #[Route("/admin/pays/creation", name:"creationPays")]
    #[Route("/admin/pays/{id}", name:"modifPays")]
    public function modification(Pays $pays = null, Request $request, EntityManagerInterface $om)
    {
        if (!$pays) {
            $pays = new Pays();
        }

        $form = $this->createForm(PaysType::class, $pays);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $destination = $pays->getPaysNom();
            $pays->setPaysDestination(strtolower(str_replace('é','e',$destination)));
            $om->persist($pays);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_pays");
        }
        return $this->render('admin/admin_pays/modification.html.twig', [
            "pays" => $pays,
            "form" => $form->createView()
        ]);
    }

    #[Route("/admin/sup/pays/{id}", name:"supPays")]
    public function suppression(Pays $pays, Request $request, EntityManagerInterface $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $pays->getId(), $request->get("_token"))) {
            $om->remove($pays);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_pays");
        }

        return new Response('Condition non valide', 200);
    }
}
