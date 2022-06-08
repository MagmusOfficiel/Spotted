<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ComptePasswordController extends AbstractController
{
    #[Route("/compte/motdepasse", name:"compte_password")]
    public function index(Request $request, UserPasswordHasherInterface $encoder,EntityManagerInterface $om): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $old_pwd = $form->get('old_password')->getData();

            if ($encoder->isPasswordValid($user, $old_pwd)) {
                $new_pwd = $form->get('new_password')->getData();
                $password = $encoder->hashPassword($user, $new_pwd);

                $user->setPassword($password);
 
                $om->flush();
             }

        }

        return $this->render('compte/password.html.twig', [
            'form' => $form->createView()
        ] );
    }
}
