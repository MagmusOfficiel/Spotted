<?php

namespace App\Controller\Admin;

use App\Entity\CodePromo;
use App\Form\CodePromoType;
use App\Repository\CodePromoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCodePromoController extends AbstractController
{
    #[Route("/admin/codepromo/", name:"admin_codepromo")]
    public function index(CodePromoRepository $repository): Response
    {
        $codepromo = $repository->findAll();

        return $this->render('admin/admin_code_promo/admincodepromo.html.twig', [
            'codepromo' => $codepromo
        ]);
    }

    #[Route("/admin/codepromo/creation", name:"creationCodePromo")]
    #[Route("/admin/codepromo/{id}", name:"modifCodePromo")]
    public function modification(CodePromo $codepromo = null, Request $request, EntityManagerInterface $om)
    {
        if (!$codepromo) {
            $codepromo = new CodePromo();
        }

        $form = $this->createForm(CodePromoType::class, $codepromo);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $date=  new \DateTime('now');
            $codepromo->setCodeDateCreation($date);
            $om->persist($codepromo);
            $om->flush();

            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_codepromo");
        }
        return $this->render('admin/admin_code_promo/modification.html.twig', [
            "codepromo" => $codepromo,
            "form" => $form->createView()
        ]);
    }

    #[Route("/admin/sup/codepromo/{id}", name:"supCodePromo")]
    public function suppression(CodePromo $codepromo, Request $request, EntityManagerInterface $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $codepromo->getId(), $request->get("_token"))) {
            $om->remove($codepromo);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_codepromo");
        }

        return new Response('Condition non valide', 200);
    }


    #[Route("/admin/codepromo/addbloque/{id}", name:"cpaddBloque")]
    public function addBloque(CodePromo $codepromo, EntityManagerInterface $om)
    {
        $bloque = $codepromo->getCodeBloque();

        if($bloque == '0') {
            $bloque++;
        } else {
            $bloque--;
        }   
        $codepromo->setCodeBloque($bloque);
        $om->persist($codepromo);
        $om->flush();
        $this->addFlash('success', "L'action a été effectué");
        return $this->redirectToRoute("admin_codepromo");
    }
}
