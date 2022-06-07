<?php

namespace App\Controller;

use App\Classe\Panier; 
use App\Entity\Commande;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeSuccessController extends AbstractController
{

    #[Route("/commande/merci/{stripeSessionId}", name:"commande_validate")]
    public function index(EntityManagerInterface $entityManager,Panier $panier, $stripeSessionId)
    {
        $commande = $entityManager->getRepository(Commande::class)->findOneByStripeSessionId($stripeSessionId);

        if (!$commande || $commande->getUtilisateur() != $this->getUser()) {
            return $this->redirectToRoute('accueil');
        }

        if ($commande->getPaye() == 0) {
            // Vider la session "cart"
            $panier->remove();

            // Modifier le statut isPaid de notre commande en mettant 1
            $commande->setPaye(1);
            $entityManager->flush();

            // Envoyer un email à notre client pour lui confirmer sa commande
           // $mail = new Email();
           // $content = "Bonjour ".$commande->getUser()->getFirstname()."<br/>Merci pour votre commande.<br><br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam expedita fugiat ipsa magnam mollitia optio voluptas! Alias, aliquid dicta ducimus exercitationem facilis, incidunt magni, minus natus nihil odio quos sunt?";
           // $mail->send($commande->getUser()->getEmail(), $commande->getUser()->getFirstname(), 'Votre commande La Boutique Française est bien validée.', $content);
        }

        return $this->render('commande_success/index.html.twig', [
            'commande' => $commande
        ]);
    }
}
