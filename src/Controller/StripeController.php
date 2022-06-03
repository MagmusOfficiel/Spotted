<?php

namespace App\Controller;

use Stripe\Stripe;
use App\Classe\Panier;
use App\Entity\Produit;
use App\Entity\Commande;
use App\Entity\CommandeDetails;
use Stripe\Checkout\Session;
use Doctrine\ORM\EntityManagerInterface; 
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StripeController extends AbstractController
{
    /**
     * @Route("/commande/create-session/{reference}", name="stripe_create_session")
     */
    public function index(EntityManagerInterface $entityManager, Panier $panier, $reference)
    {
        $products_for_stripe = [];
        $YOUR_DOMAIN = 'http://127.0.0.1:8000'; 
        $commande = $entityManager->getRepository(Commande::class)->findOneByReference($reference);
        if(!$commande){
            return $this->redirectToRoute('commande');
        }
        if (!$commande) {
            new JsonResponse(['error' => 'commande']);
        } 
        foreach ($commande->getCommandeDetails() as $produit) { 
            $product_object = $entityManager->getRepository(Produit::class)->findOneByProduitLibelle($produit->getProduits());
            $products_for_stripe[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $produit->getPrix() * 100,
                    'product_data' => [
                        'name' => $produit->getProduits(), 
                        
                    ],
                ],
                'quantity' => $produit->getQuantite(),
            ];
        }

        $products_for_stripe[] = [
            'price_data' => [
                'currency' => 'eur',
                'unit_amount' => $commande->getTransporteurPrix() * 100,
                'product_data' => [
                    'name' => $commande->getTransporteurNom(),
                    'images' => [$YOUR_DOMAIN],
                ],
            ],
            'quantity' => 1,
        ];

        Stripe::setApiKey('sk_test_51KH3GMLonUVTp1yISskEhoy5l12QMWbrz66lWl70QDIkgKwHbXRuqIopbpgBb8o4NAj7JubO1xlnqJkGivOQX3Op00Mt0u41Hu');

        $checkout_session = Session::create([
            'customer_email' => $this->getUser()->getUserMail(),
            'payment_method_types' => ['card'],
            'line_items' => [
                $products_for_stripe
            ], 
            'mode' => 'payment', 
             
            'success_url' => $YOUR_DOMAIN . '/commande/merci/{CHECKOUT_SESSION_ID}',
            'cancel_url' => $YOUR_DOMAIN . '/commande/erreur/{CHECKOUT_SESSION_ID}'
        ]); 
        $commande->setStripeSessionId($checkout_session->id);
        $entityManager->flush();

        return $this->redirect($checkout_session->url);
    }
}
