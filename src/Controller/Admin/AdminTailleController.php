<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTailleController extends AbstractController
{
    #[Route("/admin/admin/taille", name:"admin_admin_taille")]
    public function index(): Response
    {
        return $this->render('admin/admin_taille/index.html.twig', [
            'controller_name' => 'AdminTailleController',
        ]);
    }
}
