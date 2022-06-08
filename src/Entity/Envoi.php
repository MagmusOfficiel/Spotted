<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\TimestampableTrait;

#[ORM\Table(name: 'Envoi')]
#[ORM\Index(name:"idx_token", columns:["token"])]
#[ORM\Index(name:"idx_created_at", columns:["created_at"])]
#[ORM\Index(name:"idx_recipient", columns:["recipient"])]
#[ORM\Entity]
class Envoi
{
    use TimestampableTrait;

    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    protected ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    protected string $subject;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    protected ?string $recipient;

    #[ORM\Column(type: Types::STRING, length: 255)]
    protected string $titre;

    #[ORM\Column(type: Types::TEXT)]
    protected $texte;

    #[ORM\Column(type: Types::STRING, length: 255)]
    protected string $token;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function __toString()
    {
        return (string) $this->getId();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setSubject($subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setRecipient($recipient): self
    {
        $this->recipient = $recipient;

        return $this;
    }

    public function getRecipient(): string
    {
        return $this->recipient;
    }

    public function setTitre($titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTexte($texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getTexte()
    {
        return $this->texte;
    }

    public function setToken($token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
