<?php

namespace App\Controller;

use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CompteController extends AbstractController
{
    #[Route("/compte", name:"compte")]
    public function index(): Response
    {
        return $this->render('compte/index.html.twig');
    }
}
