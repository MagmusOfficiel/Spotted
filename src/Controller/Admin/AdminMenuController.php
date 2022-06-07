<?php

namespace App\Controller\Admin;

use App\Entity\Menu;
use App\Form\MenuType;
use App\Repository\MenuRepository;
use Symfony\Component\Routing\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminMenuController extends AbstractController
{
    #[Route("/admin/menu/", name:"admin_menu")]
    public function index(MenuRepository $repository): Response
    {
        $menu = $repository->findAll();

        return $this->render('admin/admin_menu/adminmenu.html.twig', [
            'menu' => $menu
        ]);
    }

    #[Route("/admin/menu/creation", name:"creationMenu")]
    #[Route("/admin/menu/{id}", name:"modifMenu")]
    public function modification(Menu $menu = null, Request $request, EntityManagerInterface $om)
    {
        if (!$menu) {
            $menu = new Menu();
        }

        $form = $this->createForm(MenuType::class, $menu);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $om->persist($menu);
            $om->flush();

            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_menu");
        }
        return $this->render('admin/admin_menu/modification.html.twig', [
            "menu" => $menu,
            "form" => $form->createView()
        ]);
    }

    #[Route("/admin/sup/menu/{id}", name:"supMenu")]
    public function suppression(Menu $menu, Request $request, EntityManagerInterface $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $menu->getId(), $request->get("_token"))) {
            $om->remove($menu);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_menu");
        }
    }

    #[Route("/admin/menu/addposition/{menuPosition}", name:"addPosition")]
    public function addPosition(Menu $menu, EntityManagerInterface $om, MenuRepository $menuRepository)
    {
        $menupre = $menuRepository->findOneBy(['menuPosition' => $menu->getMenuPosition() + 1]);
        $menupre->setMenuPosition($menu->getMenuPosition());
        $menu->setMenuPosition($menu->getMenuPosition() + 1);
        $om->persist($menu);
        $om->flush();
        $this->addFlash('success', "L'action a été effectué");
        return $this->redirectToRoute("admin_menu");
    }

    #[Route("/admin/menu/downposition/{menuPosition}", name:"downPosition")]
    public function downPosition(Menu $menu, EntityManagerInterface $om, MenuRepository $menuRepository)
    {
        $menunext = $menuRepository->findOneBy(['menuPosition' => $menu->getMenuPosition() - 1]);   
        $menunext->setMenuPosition($menu->getMenuPosition());
        $menu->setMenuPosition($menu->getMenuPosition() - 1);
        $om->persist($menu);
        $om->flush();
        $this->addFlash('success', "L'action a été effectué");
        return $this->redirectToRoute("admin_menu");
    }
}

