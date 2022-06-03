<?php

namespace App\Controller;

use App\Classe\Panier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/panier", name="panier")
     */
    public function index(Panier $panier)
    {
        return $this->render('panier/index.html.twig', [
            'panier' => $panier->getFull(), 
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="add_to_cart")
     */
    public function add(Panier $panier, $id)
    {
        $panier->add($id);

        return $this->redirectToRoute('panier');
    }

        /**
     * @Route("/panierfast/add/{id}", name="addfast_to_cart")
     */
    public function addFast(Panier $panier, $id, Request $request)
    {
        $panier->add($id);
        
        $referer = $request->headers->get('referer');
        return new RedirectResponse($referer);
    }


    /**
     * @Route("/panier/remove", name="remove_my_cart")
     */
    public function remove(Panier $panier)
    {
        $panier->remove();

        return $this->redirectToRoute('accueil');
    }

    /**
     * @Route("/panier/delete/{id}", name="delete_to_cart")
     */
    public function delete(Panier $panier, $id)
    {
        $panier->delete($id);

        return $this->redirectToRoute('panier');
    }

    /**
     * @Route("/panier/decrease/{id}", name="decrease_to_cart")
     */
    public function decrease(Panier $panier, $id)
    {
        $panier->decrease($id);

        return $this->redirectToRoute('panier');
    }
}
