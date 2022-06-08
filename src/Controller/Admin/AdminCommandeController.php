<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CommandeDetailsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCommandeController extends AbstractController
{
    #[Route("/admin/commande/", name: "admin_commande")]
    public function index(CommandeDetailsRepository $repository): Response
    {
        $commandedetails = $repository->findAll();
        return $this->render('admin/admin_commande/admincommande.html.twig', [
            'commandedetails' => $commandedetails
        ]);
    }

    #[Route("/admin/commande/{id}", name: "showCommande")]
    public function show(CommandeDetailsRepository $repository, $id): Response
    {
        $commandedetails = $repository->findById($id);
        return $this->render('admin/admin_commande/show.html.twig', [
            'commandedetails' => $commandedetails
        ]);
    }

    #[Route("/admin/sup/commande/{id}", name: "supCommande")]
    public function suppression(Commande $commande, Request $request, EntityManagerInterface $om)
    {
        if ($this->isCsrfTokenValid("SUP" . $commande->getId(), $request->get("_token"))) {
            $om->remove($commande);

            $om->flush();
            $this->addFlash('success', "L'action a été effectué");
            return $this->redirectToRoute("admin_commande");
        }

        return new Response('Condition non valide', 200);
    }

    #[Route("/admin/commande/addpaye/{id}", name: "paddPaye")]
    public function addPaye(Commande $commande, EntityManagerInterface $om)
    {
        $paye = $commande->getIsPaye();

        if ($paye == false) {
            $paye = true;
        } else {
            $paye = false;
        }
        $commande->setIsPaye($paye);
        $om->persist($commande);
        $om->flush();
        $this->addFlash('success', "L'action a été effectué");
        return $this->redirectToRoute("admin_commande");
    }



    #[Route("/export_excel", name: "admin_user_export_excel")]
    public function exportExcelAction(
        EntityManagerInterface $manager
    ): Response {
        $now = new \DateTime();

        // les utilisateurs archivés sont exclus de l'export
        $qb = $manager
            ->createQueryBuilder()
            ->select('u')
            ->from(Commande::class, 'u')
            ->orderBy('u.createdAt', 'desc');

        $users = $qb->getQuery()->getResult();
        $excel = '<table>';
        $excel .= '<tr>';
        $excel .= '<th>Nom</th>';
        $excel .= '<th>Prénom</th>';
        $excel .= '<th>Date de naissance</th>';
        $excel .= '<th>Adresse mail</th>';
        $excel .= "<th>Reference</th>";
        $excel .= "<th>Total</th>";
        $excel .= "<th>Livraison</th>";
        $excel .= "<th>Crée le</th>";
        $excel .= '<th>Transporteur</th>';
        $excel .= '<th>Paye</th>';
        $excel .= '</tr>';
        $userSource = COUNT($users);
        foreach ($users as $user) {
            $excel .= '<tr>';
            $excel .= '<td>' . $user->getUtilisateur()->getUsername() . '</td>';
            $excel .= '<td>' . $user->getUtilisateur()->getUserPrenom() . '</td>';
            $excel .= '<td>="' . $user->getUtilisateur()->getUserNaissance()->format('d/m/Y') . '"</td>';
            $excel .= '<td>' . $user->getUtilisateur()->getUserMail() . '</td>';
            $excel .= '<td>' . $user->getReference() . '</td>';
            $excel .= '<td>' . $user->getTotal() . "&euro;" . '</td>';
            $excel .= '<td>' . $user->getLivraison() . '</td>';
            $excel .= '<td>' . $user->getCreatedAt()->format('d/m/Y') . '</td>';
            $excel .= '<td>' . $user->getTransporteurNom() . '</td>';
            $excel .= '<td>' . $user->getIsPaye() . '</td>';
            $excel .= '</tr>';
        }

        $excel .= '</table>';
        if ('' === $userSource) {
            $filename = 'commande' . $now->format('Ymd_His') . '.xls';
        } else {
            $filename = 'commande' . $userSource . '_' . $now->format('Ymd_His') . '.xls';
        }

        $response = new Response(
            utf8_decode($excel),
            200,
            [
                'Content-Type' => 'application/vnd.ms-excel;charset=utf-8',
                'Content-Disposition' => 'attachment;filename:' . $filename,
            ]
        );

        return $response;
    }
}
