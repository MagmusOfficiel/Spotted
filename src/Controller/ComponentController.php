<?php

namespace App\Controller;

use Swift_Mailer;
use App\Entity\Page;
use App\Entity\Produit;
use App\Entity\Reseaux;
use App\Entity\PageInfo;
use App\Entity\Carrousel;
use App\Entity\Newsletter;
use App\Entity\ThemeImage; 
use App\Form\NewsletterType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ComponentController extends AbstractController
{
    private function getManagerRegistry(): ManagerRegistry
    {
        return $this->managerRegistry;
    } 

    public function __construct(private ManagerRegistry $managerRegistry) {
    }

    public function connexion(AuthenticationUtils $util)
    { 
        $util = new AuthenticationUtils();  
        $themeimages = $this->getManagerRegistry()
        ->getRepository(ThemeImage::class)
        ->findAll();
        return $this->render('global/connexion.html.twig', [
            'themeimages' => $themeimages,
            "lastUsername" => $util->getLastUsername(),
            "error" => $util->getLastAuthenticationError(),
        ]);
    }

    public function fetchFavIco(): Response
    {
        $themeimages = $this->getManagerRegistry()
                            ->getRepository(ThemeImage::class)->findAll();
        return $this->render('components/favicon.html.twig', [
            'themeimages' => $themeimages,
        ]);
    }

    public function fetchReseaux(): Response
    {
        $reseaux = $this->getManagerRegistry()
        ->getRepository(Reseaux::class)
        ->findAll();
        $pageinfo = $this->getManagerRegistry()
        ->getRepository(PageInfo::class)
        ->findAll();
        $page = $this->getManagerRegistry()
        ->getRepository(Page::class)
        ->findAll();
        return $this->render('footer.html.twig', [
            'reseaux' => $reseaux,
            'pageinfo' => $pageinfo,
            'page' => $page
        ]);
    }

    public function fetchNavBar( 
    ): Response {
        
        $session = new SessionInterface();
        $themeimages = $this->getManagerRegistry()
        ->getRepository(ThemeImage::class)
            ->findAll();
        $menu = $this->getManagerRegistry()
        ->getRepository(Menu::class)
            ->findAll();
        $panier = $session->get("panier", []);

        // On "fabrique" les données
        $dataPanier = [];
        $total = 0;
        $quantitetotal = 0;

        foreach ($panier as $id => $quantite) {
            $produit = $this->getManagerRegistry()
            ->getRepository(Produit::class)
                ->find($id);
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

    public function fetchNewsletter(   
    ): Response {
        
 
        $request = Request::class;
        $mailer = new Swift_Mailer(); 
        $om = new EntityManagerInterface();
        $newsLetter = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $newsLetter, [
            'action' => $this->generateUrl('newsletter'),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $om->persist($newsLetter);
            $om->flush();
            $message = (new \Swift_Message('Nouveau Reuf'))
                // On attribue l'expéditeur
                ->setFrom($newsLetter->getNewsletterMail())
                // On attribue le destintaire
                ->setTo('eddyweber80@gmail.com')
                // on crée le message avec la vue Twig
                ->setBody(
                    $this->renderView('emails/newsletter.html.twig', [
                        'newsLetter' => $newsLetter
                    ]),
                    'text/html'
                );

            // On envoie le message
            $mailer->send($message);

            $this->addFlash('message', 'Le message a bien été envoyé');
            return $this->redirectToRoute('accueil');
        }
        return $this->render('components/newsletter.html.twig', [
            'form' => $form->createView(),
            "admin" => true
        ]);
    }

    public function fetchCarrousel(): Response
    {
        $carrousels = $this->getManagerRegistry()
        ->getRepository(Carrousel::class)
            ->findAll();

        return $this->render('global/carrousel.html.twig', [
            'carrousels' => $carrousels,
        ]);
    }
}
