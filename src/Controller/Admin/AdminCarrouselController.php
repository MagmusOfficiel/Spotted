<?php

namespace App\Controller\Admin;

use App\Entity\Carrousel;
use App\Form\CarrouselType;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CarrouselRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCarrouselController extends AbstractController
{
    #[Route("/admin/carrousel/", name:"admin_carrousel")]
    public function index(CarrouselRepository $repository): Response
    {
        $carrousels = $repository->findAll();
        return $this->render('admin/admin_carrousel/admincarrousel.html.twig', [
            'carrousels' => $carrousels,
        ]);
    }

    #[Route("/admin/carrousel/creation", name:"creationCarrousel")]
    #[Route("/admin/carrousel/{id}", name:"modifCarrousel")]
    public function modification(Carrousel $carrousel = null, Request $request, EntityManagerInterface $om)
    {
        if (!$carrousel) {
            $carrousel = new Carrousel();
        }

        $form = $this->createForm(CarrouselType::class, $carrousel);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carrousel->setcarrouselDestination("carrousel");
            $om->persist($carrousel);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_carrousel");
        }
        return $this->render('admin/admin_carrousel/modification.html.twig', [
            "carrousel" => $carrousel,
            "form" => $form->createView()
        ]);
    }

    #[Route("/admin/sup/carrousel/{id}", name:"supCarrousel")]
    public function suppression(Carrousel $carrousel, Request $request, EntityManagerInterface $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $carrousel->getId(), $request->get("_token"))) {
            $om->remove($carrousel);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_carrousel");
        }

        return new Response('Condition non valide', 200);
    }

    #[Route("/admin/carrousel/addposition/{carrouselPosition}", name:"addPositionP")]
    public function addPositionP(
        Carrousel $carrousel, 
        EntityManagerInterface $om, 
        CarrouselRepository $carrouselRepository
    ): Response {
        $carrouselpre = $carrouselRepository->findOneBy(['carrouselPosition' => $carrousel->getCarrouselPosition() + 1]);
        $carrouselpre->setCarrouselPosition($carrousel->getCarrouselPosition());
        $carrousel->setCarrouselPosition($carrousel->getCarrouselPosition() + 1);
        $om->persist($carrousel);
        $om->flush();
        $this->addFlash('success', "L'action a été effectué");
        return $this->redirectToRoute("admin_carrousel");
    }

    #[Route("/admin/carrousel/downposition/{carrouselPosition}", name:"downPositionP")]
    public function downPositionP(
        Carrousel $carrousel, 
        EntityManagerInterface $om, 
        CarrouselRepository $carrouselRepository
    ): Response {
        $carrouselnext = $carrouselRepository->findOneBy(['carrouselPosition' => $carrousel->getCarrouselPosition() - 1]);   
        $carrouselnext->setCarrouselPosition($carrousel->getCarrouselPosition());
        $carrousel->setCarrouselPosition($carrousel->getCarrouselPosition() - 1);
        $om->persist($carrousel);
        $om->flush();
        $this->addFlash('success', "L'action a été effectué");
        return $this->redirectToRoute("admin_carrousel");
    }
}
