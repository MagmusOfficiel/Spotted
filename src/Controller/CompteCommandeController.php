<?php

namespace App\Controller;

use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CompteCommandeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/compte/mes-commandes", name="compte_commande")
     */
    public function index()
    {
        $commande = $this->entityManager->getRepository(Commande::class)->findSuccessOrders($this->getUser());

        return $this->render('compte/commande.html.twig', [
            'commande' => $commande
        ]);
    }

    /**
     * @Route("/compte/mes-commandes/{reference}", name="compte_commande_show")
     */
    public function show($reference)
    {
        $commande = $this->entityManager->getRepository(Commande::class)->findOneByReference($reference);

        if (!$commande || $commande->getUtilisateur() != $this->getUser()) {
            return $this->redirectToRoute('compte_commande');
        }

        return $this->render('compte/commande_show.html.twig', [
            'commande' => $commande
        ]);
    }
}
