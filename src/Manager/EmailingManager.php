<?php

namespace App\Manager;

use App\Entity\Envoi;
use Twig\Environment;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class EmailingManager
{
    /**************************
     * Attributes
     *************************/
    private Email|TemplatedEmail $message;
    private mixed $rootDir;
    private string $mailerFrom;
    private string $mailerFromName;

    /***********************
     * Specials methods
     **********************/
    public function __construct(
        private ParameterBagInterface $bag,
        private Environment $twig,
        private MailerInterface $mailer,
        private EntityManagerInterface $manager,
        private RouterInterface $router,
    ) {
        $this->mailerFrom = $bag->get('mailer_from');
        $this->mailerFromName = $bag->get('mailer_from_name');
        $this->rootDir = $bag->get('rootDir');
    }

    public function getMessage(bool $templated): array
    {
        if ($templated) {
            $this->message = (new TemplatedEmail());
        } else {
            $this->message = (new Email());
        }

        $data = [];

        return [
            'message'   => $this->message,
            'embed'     => $data
        ];
    }

    /***************************
     * Methods
     **************************/

    private function checkEmailAddresse(?string $recipient): int
    {
        $result = false;

        if (null !== $recipient) {
            $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
            $result = preg_match($pattern, $recipient);
        }

        return (false !== $result) ? $result : 0;
    }

    public function logEmail($sent, $token, $recipient, $subject, $titre, $texte)
    {
        $envoi = new Envoi();
        $envoi->setToken($token);
        $envoi->setRecipient($recipient);
        $envoi->setSubject($subject);
        $envoi->setTitre(str_replace('<br>', ' ', $titre));
        $envoi->setTexte($texte);
        $this->manager->persist($envoi);
    }

    /**
     * Gère l'envoie des mails
     */
    public function sendMail(
        array|string $recipient,
        string $subject,
        ?string $titre,
        ?string $texte,
        ?string $mail,
        ?string $token = null,
        ?array $context = [],
        ?string $attach = null,
        bool $log = true
    ): bool {
        if (null === $token) {
            $token = md5(rand());
        }
        $sent = false;
        if (empty($context)) {
            $data = $this->getMessage(false);
            $message = $data['message'];
            $message
                ->html($texte);
        } else {
            $data = $this->getMessage(true);
            $message = $data['message'];
            $message
                ->htmlTemplate($mail);
            if (null !== $attach) {
                $message->attach($attach);
            }
        }

        $message->subject($subject)
            ->from(new Address($this->mailerFrom, $this->mailerFromName));

        if (is_array($recipient)) {
            for ($i = 0; $i < count($recipient); $i++) {
                if (0 === $i) {
                    $message->to($recipient[$i]);
                } else {
                    $message->addTo($recipient[$i]);
                }
            }
        } else {
            $message->to($recipient);
        }

        try {
            $this->mailer->send($message);
            $sent = true;
        } catch (TransportExceptionInterface $e) {
            echo 'Exception reçue: ', $e->getMessage(), "\n";
        }
        if ($log) {
            $this->logEmail($sent, $token, $recipient, $subject, $titre, $texte);
        }
        return $sent;
    }


    /**
     * Il envoie un e-mail de reinstillisation de mot de passe
     */
    public function sendResetPassword($emailFormData, $resetToken): bool
    {

        $sent = false;

        $token = md5(rand());
        $subject = 'Votre demande de réinitialisation de mot de passe';
        $message =
            $this->twig->render(
                'reset_password/email.html.twig',
                [
                    'resetToken' => $resetToken,
                ]
            );
        $checkMail = $this->checkEmailAddresse($emailFormData);
        if ($checkMail === 1) {
            $sent = $this->sendMail($emailFormData, $subject, null, $message, $token);
        }

        return $sent;
    }

    /**
     * Il envoie un e-mail de contact
     */
    public function sendMailContact($email, $subject, $message): bool
    {
        $sent = false;
        $token = md5(rand());
        $checkMail = $this->checkEmailAddresse($email);
        if ($checkMail === 1) {
            $sent = $this->sendMail($email, $subject, null, $message, $token);
        }

        return $sent;
    }
}
