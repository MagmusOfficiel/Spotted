<?php

namespace App\Controller;

use App\Entity\Commande;
use Symfony\Component\Routing\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeCancelController extends AbstractController
{

    #[Route("/commande/erreur/{stripeSessionId}", name: "commande_cancel")]
    public function index(EntityManagerInterface $entityManager, $stripeSessionId)
    {
        $commande = $entityManager->getRepository(Commande::class)->findOneByStripeSessionId($stripeSessionId);

        if (!$commande || $commande->getUser() != $this->getUser()) {
            return $this->redirectToRoute('accueil');
        }

        // Envoyer un email à notre utilisateur pour lui indiquer l'échec de paiement

        return $this->render('commande_cancel/index.html.twig', [
            'commande' => $commande
        ]);
    }
}
