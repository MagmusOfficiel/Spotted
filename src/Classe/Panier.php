<?php

namespace App\Classe;

use App\Entity\Produit;
use Stripe\BillingPortal\Session;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Panier
{
    private $session;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->session = $session;
        $this->entityManager = $entityManager;
    }

    # Récupére la session panier #
    public function get()
    {
        return $this->session->get('panier');
    }

    # Ajoute une quantité lors de l'appuie du bouton #
    public function add($id)
    {
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }
        $this->session->set('panier', $panier);
    }

    # Supprime une quantité lors de l'appuie du bouton #
    public function decrease($id)
    {
        $panier = $this->session->get('panier', []);

        if ($panier[$id] > 1) {
            $panier[$id]--;
        } else {
            unset($panier[$id]);
        }

        return $this->session->set('panier', $panier);
    }

    # Supprime une ligne de données lors de l'appuie du bouton #
    public function delete($id)
    {
        $panier = $this->session->get('panier', []);

        unset($panier[$id]);

        return $this->session->set('panier', $panier);
    }

    # Supprime toute la session et les données du panier #
    public function remove()
    {
        return $this->session->remove('panier');
    }

    public function getFull()
    {
        $panierComplete = [];


        if ($this->get()) {
            foreach ($this->get() as $id => $quantite) {
                $produit_object = $this->entityManager->getRepository(Produit::class)->findOneById($id);

                if (!$produit_object) {
                    $this->delete($id);
                    continue;
                }
                $panierComplete[] = [
                    'produit' => $produit_object,
                    'quantite' => $quantite
                ];
            }
        }

        return $panierComplete;
    }
}
