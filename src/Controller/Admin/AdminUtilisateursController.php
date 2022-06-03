<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminUtilisateursController extends AbstractController
{
    /**
     * @Route("/admin/utilisateurs/", name="admin_utilisateurs")
     */
    public function index(UtilisateurRepository $repository): Response
    {
        $utilisateurs = $repository->findAll();

        return $this->render('admin/admin_utilisateurs/adminutilisateur.html.twig', [
            'utilisateurs' => $utilisateurs
        ]);
    }

    /**
     * @Route("/admin/utilisateurs/creation", name="creationUtilisateur")
     * @Route("/admin/utilisateurs/{id}", name="modifUtilisateur")
     */
    public function modification(Utilisateur $utilisateur = null, Request $request, EntityManagerInterface $om, UserPasswordEncoderInterface $encoder)
    {
        if (!$utilisateur) {
            $utilisateur = new Utilisateur();
        }

        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $role = $form->get('roles')->getData();
            $passwordCrypte = $encoder->encodePassword($utilisateur, $utilisateur->getPassword());
            $utilisateur->setPassword($passwordCrypte)
                ->setRoles($role);
            $om->persist($utilisateur);
            $om->flush();

            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_utilisateurs");
        }
        return $this->render('admin/admin_utilisateurs/modification.html.twig', [
            "utilisateur" => $utilisateur,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/sup/utilisateurs/{id}", name="supUtilisateur")
     */
    public function suppression(Utilisateur $utilisateur, Request $request, EntityManagerInterface $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $utilisateur->getId(), $request->get("_token"))) {
            $om->remove($utilisateur);

            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_utilisateurs");
        }

        return new Response('Condition non valide', 200);
    }
}
