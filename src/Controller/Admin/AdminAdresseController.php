<?php

namespace App\Controller\Admin;

use App\Entity\Adresse;
use App\Form\AdresseType;
use Symfony\Component\Routing\Route;
use App\Repository\AdresseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAdresseController extends AbstractController
{
    #[Route("/admin/adresse/", name:"admin_adresse")]
    public function index(AdresseRepository $repository): Response
    {
        $adresse = $repository->findAll();

        return $this->render('admin/admin_adresse/adminadresse.html.twig', [
            'adresse' => $adresse
        ]);
    }


    #[Route("/admin/adresse/creation", name:"creationAdresse")]
    #[Route("/admin/adresse/{id}", name:"modifAdresse")]
    public function modification(
        Adresse $adresse = null,
        Request $request,
        EntityManagerInterface $om
    ) : Response {
        if (!$adresse) {
            $adresse = new Adresse();
        }

        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $om->persist($adresse);
            $om->flush();

            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_adresse");
        }
        return $this->render('admin/admin_adresse/modification.html.twig', [
            "adresse" => $adresse,
            "form" => $form->createView()
        ]);
    }

    #[Route("/admin/sup/adresse/{id}", name:"supAdresse")]
    public function suppression(Adresse $adresse, Request $request, EntityManagerInterface $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $adresse->getId(), $request->get("_token"))) {
            $om->remove($adresse);

            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_adresse");
        }

        return new Response('Condition non valide', 200);
    }
}
