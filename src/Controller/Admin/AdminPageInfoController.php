<?php

namespace App\Controller\Admin;

use App\Entity\PageInfo;
use App\Form\PageInfoType;
use Symfony\Component\Routing\Route;
use App\Repository\PageInfoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPageInfoController extends AbstractController
{
    #[Route("/admin/pageinfo/", name:"admin_pageinfo")]
    public function index(PageInfoRepository $repository): Response
    {
        $pageinfo = $repository->findAll();

        return $this->render('admin/admin_pageinfo/adminpageinfo.html.twig', [
            'pageinfo' => $pageinfo
        ]);
    }


    #[Route("/admin/pageinfo/creation", name:"creationPageInfo")]
    #[Route("/admin/pageinfo/{id}", name:"modifPageInfo")]
    public function modification(PageInfo $pageinfo = null, Request $request, EntityManagerInterface $om)
    {
        if (!$pageinfo) {
            $pageinfo = new PageInfo();
        }

        $form = $this->createForm(PageInfoType::class, $pageinfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $om->persist($pageinfo);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_pageinfo");
        }
        return $this->render('admin/admin_pageinfo/modification.html.twig', [
            "pageinfo" => $pageinfo,
            "form" => $form->createView()
        ]);
    }

    #[Route("/admin/sup/pageinfo/{id}", name:"supPageInfo")]
    public function suppression(PageInfo $pageinfo, Request $request, EntityManagerInterface $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $pageinfo->getId(), $request->get("_token"))) {
            $om->remove($pageinfo);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_pageinfo");
        }

        return new Response('Condition non valide', 200);
    }
}
