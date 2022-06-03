<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $message = (new Email())
                ->subject('Nouveau Contact')
                // On attribue l'expéditeur
                ->from($contact['email'])
                // On attribue le destintaire
                ->to('eddyweber80@gmail.com')
                // on crée le message avec la vue Twig
                ->html(
                    $this->renderView(
                        'emails/contact.html.twig',
                        compact('contact')
                    ),
                    'text/html'
                );

            // On envoie le message
            $mailer->send($message);

            $this->addFlash('message', 'Le message a bien été envoyé');
            return $this->redirectToRoute('accueil');
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
