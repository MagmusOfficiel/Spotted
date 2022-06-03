<?php

namespace App\Controller\Admin;

use App\Entity\ThemeImage;
use App\Form\ThemeImageType;
use App\Repository\ThemeImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminThemeImageController extends AbstractController
{
    /**
     * @Route("/admin/themeimage/", name="admin_themeimage")
     */
    public function index(ThemeImageRepository $repository): Response
    {
        $themeimages = $repository->findAll();
        return $this->render('admin/admin_themeimage/adminthemeimage.html.twig', [
            'themeimages' => $themeimages,
        ]);
    }

        /**
     * @Route("/admin/themeimage/creation", name="creationImage")
     * @Route("/admin/themeimage/{id}", name="modifImage")
     */
    public function modification(ThemeImage $themeimage = null, Request $request, EntityManagerInterface $om)
    {
        if (!$themeimage) {
            $themeimage = new ThemeImage();
        }

        $form = $this->createForm(ThemeImageType::class, $themeimage);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $om->persist($themeimage);
            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_themeimage");
        }
        return $this->render('admin/admin_themeimage/modification.html.twig', [
            "themeimage" => $themeimage,
            "form" => $form->createView()
        ]);
    }

}
