<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Entity\Page;
use App\Entity\Produit;
use App\Entity\Newsletter;
use App\Entity\Utilisateur;
use App\Form\NewsletterType;
use App\Form\InscriptionType;
use App\Classe\ProduitRecherche;
use App\Service\SendMailService;
use App\Form\ProduitRechercheType;
use App\Repository\MenuRepository;
use App\Repository\PageRepository;
use Symfony\Component\Routing\Route;
use App\Repository\ProduitRepository;
use App\Repository\PageInfoRepository;
use App\Repository\ThemeImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class GlobalController extends AbstractController
{

    #[Route("/", name: "accueil")]
    public function index(
        SessionInterface $session,
        ThemeImageRepository $repository,
        EntityManagerInterface $om,
        Request $request
    ): Response {
        $themeimages = $repository->findAll();
        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('admin');
        };
        // API COULEUR - Récupérer la couleur envoyer par le formulaire 
        $couleur = '#110b23';
        if ($request->isMethod('POST')) {
            $couleur = $request->request->get("couleur");
            $session->set("couleur", $couleur);
        } else {
            $couleur = $session->get("couleur");
        }

        // FIN API COULEUR

        $produits = $om->getRepository(Produit::class)->findAll();

        return $this->render('global/index.html.twig', [
            'themeimages' => $themeimages,
            'produits' => $produits,
            'couleur' => $couleur
        ]);
    }


    #[Route("/inscription", name: "inscription")]
    public function inscription(
        Request $request,
        ThemeImageRepository $repository2,
        EntityManagerInterface $om,
        UserPasswordHasherInterface $encoder,
        SendMailService $mail
    ): Response {
        $utilisateur = new Utilisateur();
        $themeimages = $repository2->findAll();
        $form = $this->createForm(InscriptionType::class, $utilisateur, [
            'action' => $this->generateUrl('inscription'),
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $passwordCrypte = $encoder->hashPassword($utilisateur, $utilisateur->getPassword());
            $utilisateur->setPassword($passwordCrypte);
            $utilisateur->setRoles("ROLE_USER");
            $om->persist($utilisateur);
            $om->flush();
            $context = [
                'mail' => $form->get('userMail')->getData(),
                'nom' => $form->get('username')->getData(),
                'prenom' => $form->get('userPrenom')->getData()
            ];

            $mail->send(
                $form->get('userMail')->getData(),
                'eddyweber80@gmail.com',
                'Inscription Spotted',
                'inscription',
                $context
            );
            $this->addFlash('success', "Félicitation vous venez de vous inscrire ! Nous vous avons envoyé un mail pour confirmer votre inscription");
            return $this->redirectToRoute("accueil");
        }

        return $this->render('global/inscription.html.twig', [
            'themeimages' => $themeimages,
            "form" => $form->createView()
        ]);
    }

    #[Route("/connexion", name: "connexion")]
    public function connexion(AuthenticationUtils $util, ThemeImageRepository $repository2): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('compte');
        }

        $themeimages = $repository2->findAll();
        return $this->render('global/connexion.html.twig', [
            'themeimages' => $themeimages,
            "lastUsername" => $util->getLastUsername(),
            "error" => $util->getLastAuthenticationError(),
        ]);
    }


    #[Route("/logout", name: "logout")]
    public function logout()
    {
    }


    #[Route("/produit/{id}", name: "produitId")]
    public function fetchProduit(Produit $produit, ProduitRepository $repository): Response
    {
        $produit = $repository->findById($produit);
        return $this->render('global/produitid.html.twig', [
            'produit' => $produit,
        ]);
    }


    #[Route("/navbar", name: "navbar")]
    public function fetchNavBar(
        ThemeImageRepository $repository,
        SessionInterface $session,
        ProduitRepository $produitRepository,
        MenuRepository $repository2
    ): Response {
        $themeimages = $repository->findAll();
        $menu = $repository2->findAll();
        $panier = $session->get("panier", []);

        // On "fabrique" les données
        $dataPanier = [];
        $total = 0;
        $quantitetotal = 0;

        foreach ($panier as $id => $quantite) {
            $produit = $produitRepository->find($id);
            $dataPanier[] = [
                "produit" => $produit,
                "quantite" => $quantite
            ];
            $total += $produit->getProduitPrix() * $quantite;
            $quantitetotal += $quantite;
        }

        return $this->render('navbar.html.twig', [
            'quantitetotal' => $quantitetotal,
            'total' => $total,
            'dataPanier' => $dataPanier,
            'menu' => $menu,
            'themeimages' => $themeimages,
        ]);
    }


    #[Route("/newsletter", name: "newsletter")]
    public function fetchNewsletter(
        Request $request,
        SendMailService $mail,
        EntityManagerInterface $om
    ): Response {
        $newsLetter = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $newsLetter, [
            'action' => $this->generateUrl('newsletter'),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $om->persist($newsLetter);
            $om->flush();
            $context = [
                'mail' => $form->get('newsletterMail')->getData()
            ];

            $mail->send(
                $form->get('newsletterMail')->getData(),
                'eddyweber80@gmail.com',
                'Inscription newsletters',
                'newsletter',
                $context
            );


            $this->addFlash('message', 'Le message a bien été envoyé');
            return $this->redirectToRoute('accueil');
        }
        return $this->render('components/newsletter.html.twig', [
            'form' => $form->createView(),
            "admin" => true
        ]);
    }

    #[Route("/menu/{menuNom}", name: "menuNom")]
    public function fetchMenu(
        Menu $menu,
        MenuRepository $repository,
        ProduitRepository $repository2,
        Request $request
    ): Response {
        $produit = $repository2->findAll();
        $menuid = $menu->getId();
        $recherche = new ProduitRecherche();

        $form = $this->createForm(ProduitRechercheType::class, $recherche);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $produit = $repository2->findWithSearch($recherche);
        } else {
            $produit = $repository2->findAll();
        }
        $menu = $repository->findBy([
            'id' => $menuid // On passe l'id du menu
        ]);
        return $this->render('global/menu.html.twig', [
            'menu' => $menu,
            'form' => $form->createView(),
            'produit' => $produit,
        ]);
    }



    #[Route("/page/{pageUrlSimple}", name: "pageUrlSimple")]
    public function fetchPage(
        Page $page,
        PageRepository $repository,
        PageInfoRepository $repository2
    ): Response {
        $pageinfo = $repository2->findAll();
        $pageid = $page->getId();
        $page = $repository->findBy([
            'id' => $pageid // On passe l'id du menu
        ]);
        return $this->render('global/page.html.twig', [
            'page' => $page,
            'pageinfo' => $pageinfo,
        ]);
    }

    #[Route("/couleursession", name: "couleurSession")]
    public function couleurSession(SessionInterface $session)
    {
        $session->remove("couleur");

        return $this->redirectToRoute("accueil");
    }
}
