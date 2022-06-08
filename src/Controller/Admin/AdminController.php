<?php

namespace App\Controller\Admin;

use App\Service\DateYear;
use App\Classe\FiltreYear;
use App\Form\FiltreYearType;
use Symfony\UX\Chartjs\Model\Chart;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitRepository;
use App\Repository\CommandeRepository; 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AdminController extends AbstractController
{

    #[Route("/admin", name:"admin")]
    public function index(
        ChartBuilderInterface $chartBuilder,
        CommandeRepository $commandeRepository,
        ProduitRepository $produitRepository,
        DateYear $dateYear,
        Request $request
    ): Response {
        $dateRecup = new FiltreYear();
        $form = $this->createForm(FiltreYearType::class, $dateRecup);
        $dateRecup = $request->query->get('dateAnnee');
        if ($dateRecup) {
            $commande = $commandeRepository->findStatsCommandeAnnee((int)$dateRecup);
        } else {
            $commande = $commandeRepository->findStatsCommandeAnnee(date('Y'));
        };

        $months = [];

        for ($i = 1; $i <= 12; $i++) {
            $months[] = $dateYear->dateYear($commande, $i);
        }
        $chartOne = $chartBuilder->createChart(Chart::TYPE_LINE);

        $chartOne->setData([
            'labels' => ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
            'datasets' => [
                [
                    'label' => 'Nombre de commande ' . ($dateRecup ? $dateRecup : date('Y')),
                    'backgroundColor' => 'rgb(101, 159, 240)',
                    'borderColor' => 'rgb(101, 159, 240)',
                    'data' => [$months[0], $months[1], $months[2], $months[3], $months[4], $months[5], $months[6], $months[7], $months[8], $months[9], $months[10], $months[11]]
                ],
            ],
        ]);

        $chartOne->setOptions([
            'animations' => [
                'tension' => [
                    'duration' => 1000,
                    'easing' => 'linear',
                    'from' => 0.2,
                    'to' => 0,
                    'loop' => true
                ],
            ],
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);

        $produit = $produitRepository->findAll();
        foreach ($produit as $produits) { 
           $test[] = $produits->getMarques()->getMarqueNom();
        }

        $chartTwo = $chartBuilder->createChart(Chart::TYPE_PIE);

        $chartTwo->setData([
            'labels' => ['Nike', 'Adidas', 'North Face'],
            'datasets' => [
                [
                    'label' => 'Nombre de produit par marques',
                    'backgroundColor' => ["rgb(102, 22, 33)", "rgb(255, 99, 132)", "rgb(230, 50, 60)"],
                    'borderColor' =>  ["rgb(102, 22, 33)", "rgb(255, 99, 132)", "rgb(230, 50, 60)"],
                    'data' => [2, 10, 5],
                ],
            ],
        ]);

        $chartTwo->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);

        return $this->render('admin/index.html.twig', [
            'form' => $form->createView(),
            'chartOne' => $chartOne,
            'chartTwo' => $chartTwo,
        ]);
    }

    #[Route("/admin/get/navbar", name:"get_navbar")]
    public function getNavBar(TokenStorageInterface $tokenStorage)
    {

        /**
         * Récupérer un utilisateur peut importe la classe 
         * (Controller ou service ou listener etc...)
         */
        /*         $user = null;
        $token = $tokenStorage->getToken();
        if ($token !== null) {
            $user = $token->getUser();
            dd($token);
            // 1er moyen de vérifier qu'un utilisateur est connecté
            if ($user !== 'anon.' && $user !== null) {
                // Il est connecté
            } else {
                // Il est pas connecté
            }

            // 2ème moyen de vérifier qu'un utilisateur est connecté
            if ($user instanceof Utilisateur) {
                // Il est connecté
            } else {
                // Il est pas connecté
            }
        } */

        return $this->render('admin/navbar.html.twig', []);
    }
}
