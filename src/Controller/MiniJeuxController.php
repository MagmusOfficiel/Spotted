<?php

namespace App\Controller;

use App\Entity\Points;
use App\Repository\PointsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MiniJeuxController extends AbstractController
{
    #[Route('/{reactRouting}', name: 'index', defaults:["reactRouting" => null])]
    public function index(
        PointsRepository $repository2,): Response
    {
        
        if (null !== $this->getUser()) {
            $points = $repository2->find($this->getUser()->getPoints()->getId());
        } else {
            $points = null;
        };
        return $this->render('mini_jeux/index.html.twig', [ 
            'points' => $points
        ]);
    }

    #[Route('/mini_jeux/test', name: 'miniJeuxTest')]
    public function test(
        PointsRepository $repository2,): Response
    {
        
        if (null !== $this->getUser()) {
            $points = $repository2->find($this->getUser()->getPoints()->getId());
        } else {
            $points = null;
        };
        return $this->render('mini_jeux/test.html.twig', [ 
            'points' => $points
        ]);
    }

    #[Route('/mini_jeux/points', name: 'jeuxPoints')]
    public function recupPoints(
        Points $points = null,
        EntityManagerInterface $om,
        PointsRepository $repository
    ): Response {
        $date = new \DateTime('now');
        $user = $this->getUser();
        if (null !== $user) {
            if (null !== $user->getPoints()) {
                $points = $repository->find($this->getUser()->getPoints()->getId());
            }
            if (!$points) {
                $points = new Points();
                $points->setUserPoints($user);
            }
            if ($date >= $points->getDateExpiration()) {
                $date = new \DateTimeImmutable('now');
                $coins = $points->getNbrPoints();
                $points->setNbrPoints($points->getNbrPoints() + rand(0, 100));
                $points->setCreatedAt($date);
                $points->setDateExpiration($date->modify('+5 minute'));
                $om->persist($points);
                $om->flush();
                $coinsNew = "+ " . $points->getNbrPoints() - $coins;
                $this->addFlash('coins', $coinsNew);
            } else {
                $this->addFlash('wtf', "Nope !");
            }
        }
        return $this->redirectToRoute("miniJeux");
    }
}
