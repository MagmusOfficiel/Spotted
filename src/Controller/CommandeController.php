<?php

namespace App\Controller;

use App\Classe\Panier;
use App\Entity\Commande;
use App\Entity\CodePromo;
use App\Form\CommandeType;
use App\Form\CodePromoType;
use App\Entity\CommandeDetails;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{

    private $session;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;
    }
    /**
     * @Route("/commande", name="commande")
     */
    public function index(Panier $panier, Request $request): Response
    {
        if (!$this->getUser() == null) {
            if (!$this->getUser()->getAdresses()->getValues()) {
                return $this->redirectToRoute('compte_adresse_add');
            };
        } else {
            $this->addFlash('danger', 'Merci de vous inscrire avant de faire une commande');
            return $this->redirectToRoute('accueil');
        }

        if (isset($_POST['codepromo'])) {
            $codepromo = $_POST['codepromo'];
            $promo = $this->entityManager->getRepository(CodePromo::class)->findOneByCodeCode($codepromo);
            $this->session->set('promo', $promo);
        } else {
            $this->session->remove('promo');
            $promo = null;
        }

        $form = $this->createForm(CommandeType::class, null, [
            'user' => $this->getUser()
        ]);

        return $this->render('commande/index.html.twig', [
            'form' => $form->createView(),
            'panier' => $panier->getFull(),
            'promo' => $promo
        ]);
    }

    /**
     * @Route("/commande/recapitulatif", name="commande_recap", methods={"POST"})
     */
    public function add(Panier $panier, Request $request)
    {

        if ($this->session->get('promo')) {
            $promo = $this->entityManager->getRepository(CodePromo::class)->findOneByCodeCode($this->session->get('promo')->getCodeCode());
        } else {
            $promo = null;
        }
        $form = $this->createForm(CommandeType::class, null, [
            'user' => $this->getUser()
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $date = new \DateTime();
            $transporteur = $form->get('transporteur')->getData();

            $livraison = $form->get('adresses')->getData();
            $livraison_content = $livraison->getFirstname() . ' ' . $livraison->getLastname();
            $livraison_content .= '<br/>' . $livraison->getPhone();

            if ($livraison->getCompany()) {
                $livraison_content .= '<br/>' . $livraison->getCompany();
            }

            $livraison_content .= '<br/>' . $livraison->getAddress();
            $livraison_content .= '<br/>' . $livraison->getPostal() . ' ' . $livraison->getCity();
            $livraison_content .= '<br/>' . $livraison->getCountry();

            // Enregistrer ma commande Order()
            $commande = new Commande();
            $reference = $date->format('dmY') . '-' . uniqid();
            $commande->setReference($reference)
                ->setUtilisateur($this->getUser())
                ->setCreatedAt($date)
                ->setTransporteurNom($transporteur->getTransporteurNom())
                ->setTransporteurPrix($transporteur->getTransporteurPrix())
                ->setLivraison($livraison_content)
                ->setPaye(0);

            $this->entityManager->persist($commande);
            // Enregistrer mes produits OrderDetails()
            foreach ($panier->getFull() as $produits) {
                $commandeDetails = new CommandeDetails();
                if ($this->session->get('promo') !== null ) {
                    $commandeDetails->setMaCommande($commande)
                        ->setProduits($produits['produit']->getProduitLibelle())
                        ->setQuantite($produits['quantite'])
                        ->setPrix($produits['produit']->getProduitPrix())
                        ->setTotal($produits['produit']->getProduitPrix() * $produits['quantite'] - $promo->getCodeMontant());
                } else {
                    $commandeDetails->setMaCommande($commande)
                        ->setProduits($produits['produit']->getProduitLibelle())
                        ->setQuantite($produits['quantite'])
                        ->setPrix($produits['produit']->getProduitPrix())
                        ->setTotal($produits['produit']->getProduitPrix() * $produits['quantite']);
                }

                $this->entityManager->persist($commandeDetails);
            }

            $this->entityManager->flush();

            return $this->render('commande/add.html.twig', [
                'panier' => $panier->getFull(),
                'promo' => $promo,
                'transporteur' => $transporteur,
                'livraison' => $livraison_content,
                'reference' => $commande->getReference()
            ]);
        }

        return $this->redirectToRoute('panier');
    }
}
