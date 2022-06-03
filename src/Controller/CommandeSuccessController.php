<?php

namespace App\Controller;

use App\Classe\Panier;
use App\Classe\Mail;
use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommandeSuccessController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/commande/merci/{stripeSessionId}", name="commande_validate")
     */
    public function index(Panier $panier, $stripeSessionId)
    {
        $commande = $this->entityManager->getRepository(Commande::class)->findOneByStripeSessionId($stripeSessionId);

        if (!$commande || $commande->getUtilisateur() != $this->getUser()) {
            return $this->redirectToRoute('accueil');
        }

        if ($commande->getPaye() == 0) {
            // Vider la session "cart"
            $panier->remove();

            // Modifier le statut isPaid de notre commande en mettant 1
            $commande->setPaye(1);
            $this->entityManager->flush();

            // Envoyer un email à notre client pour lui confirmer sa commande
           // $mail = new Mail();
            // $content = "Bonjour ".$order->getUser()->getFirstname()."<br/>Merci pour votre commande.<br><br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam expedita fugiat ipsa magnam mollitia optio voluptas! Alias, aliquid dicta ducimus exercitationem facilis, incidunt magni, minus natus nihil odio quos sunt?";
           // $mail->send($order->getUser()->getEmail(), $order->getUser()->getFirstname(), 'Votre commande La Boutique Française est bien validée.', $content);
        }

        return $this->render('commande_success/index.html.twig', [
            'commande' => $commande
        ]);
    }
}
