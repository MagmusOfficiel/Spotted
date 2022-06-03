<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use App\Form\PageType;
use App\Repository\PageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPageController extends AbstractController
{
    /**
     * @Route("/admin/page/", name="admin_page")
     */
    public function index(PageRepository $repository): Response
    {
        $page = $repository->findAll();

        return $this->render('admin/admin_page/adminpage.html.twig', [
            'page' => $page
        ]);
    }


    /**
     * @Route("/admin/page/creation", name="creationPage")
     * @Route("/admin/page/{id}", name="modifPage")
     */
    public function modification(Page $page = null, Request $request, EntityManagerInterface $om)
    {
        if (!$page) {
            $page = new Page();
        }

        $form = $this->createForm(PageType::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $om->persist($page);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_page");
        }
        return $this->render('admin/admin_page/modification.html.twig', [
            "page" => $page,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/sup/page/{id}", name="supPage")
     */
    public function suppression(Page $page, Request $request, EntityManagerInterface $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $page->getId(), $request->get("_token"))) {
            $om->remove($page);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_page");
        }

        return new Response('Condition non valide', 200);
    }

    /**
     * @Route("/admin/page/addbloque/{id}", name="paddBloque")
     */
    public function addBloque(Page $page, EntityManagerInterface $om)
    {
        $bloque = $page->getPageBloque();

        if ($bloque == '0') {
            $bloque++;
        } else {
            $bloque--;
        }
        $page->setPageBloque($bloque);
        $om->persist($page);
        $om->flush();
        $this->addFlash('success', "L'action a été effectué");
        return $this->redirectToRoute("admin_page");
    }
}
