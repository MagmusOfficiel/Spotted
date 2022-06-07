<?php

namespace App\Controller\Admin;

use App\Entity\CarteCadeau;
use App\Form\CarteCadeauType; 
use Symfony\Component\Routing\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CarteCadeauRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCarteCadeauController extends AbstractController
{
    #[Route("/admin/cartecadeau/", name:"admin_cartecadeau")]
    public function index(CarteCadeauRepository $repository): Response
    {
        $cartecadeau = $repository->findAll();
        return $this->render('admin/admin_cartecadeau/admincartecadeau.html.twig', [
            'cartecadeau' => $cartecadeau
        ]);
    }

    #[Route("/admin/creation/cartecadeau", name:"creationCarteCadeau", methods:["GET","POST"])]
    #[Route("/admin/cartecadeau/{id}", name:"modifCarteCadeau")]
    public function modification(CarteCadeau $cartecadeau = null, Request $request, EntityManagerInterface $om)
    {
        if (!$cartecadeau) {
            $cartecadeau = new CarteCadeau();
        }

        $form = $this->createForm(CarteCadeauType::class, $cartecadeau);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {  
            $date=  new \DateTime('now');
            $cartecadeau->setCarteCadeauCreation($date); 
            $om->persist($cartecadeau);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute('admin_cartecadeau');
        }
        return $this->render('admin/admin_cartecadeau/modification.html.twig', [
            "cartecadeau" => $cartecadeau,
            "form" => $form->createView()
        ]);
    }

    #[Route("/admin/sup/cartecadeau/{id}", name:"supCarteCadeau")]
    public function suppression(CarteCadeau $cartecadeau, Request $request, EntityManagerInterface $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $cartecadeau->getId(), $request->get("_token"))) {
            $om->remove($cartecadeau);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_cartecadeau");
        }

        return new Response('Condition non valide', 200);
    }

    #[Route("/admin/cartecadeau/addbloque/{id}", name:"caddCarteCadeau")]
    public function addBloque(CarteCadeau $cartecadeau, EntityManagerInterface $om)
    {
        $bloque = $cartecadeau->getCarteCadeauBloque();

        if($bloque == '0') {
            $bloque++;
        } else {
            $bloque--;
        }   
        $cartecadeau->setCarteCadeauBloque($bloque);
        $om->persist($cartecadeau);
        $om->flush();
        $this->addFlash('success', "L'action a été effectué");
        return $this->redirectToRoute("admin_cartecadeau");
    }
}
