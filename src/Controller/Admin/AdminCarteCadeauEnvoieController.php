<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCarteCadeauEnvoieController extends AbstractController
{
    #[Route("/admin/admin/carte/cadeau/envoie", name:"admin_admin_carte_cadeau_envoie")]
    public function index(): Response
    {
        return $this->render('admin/admin_carte_cadeau_envoie/index.html.twig', [
            'controller_name' => 'AdminCarteCadeauEnvoieController',
        ]);
    }
}
