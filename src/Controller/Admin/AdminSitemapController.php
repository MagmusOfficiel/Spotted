<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Router;

class AdminSitemapController extends AbstractController
{
    #[Route("admin/sitemap.xml", name: "sitemap", defaults: ["format" => "xml"])]
    public function index(Request $request)
    {

        /** @var $router \Symfony\Component\Routing\Router */
        $router = $this->container->get('router');
        /** @var $collection \Symfony\Component\Routing\RouteCollection */
        $collection = $router->getRouteCollection();
        $allRoutes = $collection->all();

        // Nous récupérons le nom d'hôte depuis l'URL
        $hostname = $request->getSchemeAndHttpHost();


        // Fabrication de la réponse XML
        $response = new Response(
            $this->renderView(
                'sitemap/index.html.twig',
                [
                    'routes' => $allRoutes,
                    'hostname' => $hostname
                ]
            )
        );

        // Ajout des entêtes
        $response->headers->set('Content-Type', 'text/xml');

        // On envoie la réponse
        return $response;
    }
}
