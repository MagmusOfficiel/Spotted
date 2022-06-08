<?php

namespace App\Controller;

use App\Entity\CarteCadeauEnvoie;
use App\Form\CarteCadeauEnvoieType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CarteCadeauRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarteCadeauController extends AbstractController
{
    #[Route("/cartecadeau", name: "cartecadeau")]
    public function index(CarteCadeauRepository $repository, Request $request, EntityManagerInterface $om, CarteCadeauEnvoie $cartecadeauenvoie = null): Response
    {
        $cartecadeauenvoie = new CarteCadeauEnvoie();
        $cartecadeau = $repository->findAll();
        $form = $this->createForm(CarteCadeauEnvoieType::class, $cartecadeauenvoie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $montant = $form->get('carteMontant')->getData();
            $cartecadeauenvoie->setCarteMontant($montant);

            $theme = $request->request->get('carteTheme');
            $cartTheme = $repository->find($theme);
            $cartecadeauenvoie->setCarteTheme($cartTheme);

            $om->persist($cartecadeauenvoie);
            $om->flush();
        }

        return $this->render('cartecadeau/index.html.twig', [
            "cartecadeau" => $cartecadeau,
            'form' => $form->createView()
        ]);
    }
}
