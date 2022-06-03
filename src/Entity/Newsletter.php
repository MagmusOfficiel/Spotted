<?php

namespace App\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use App\Repository\NewsletterRepository;

/**
 * @ORM\Entity(repositoryClass=NewsletterRepository::class)
 */
class Newsletter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $newsletterMail;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * 
     * @var \Datetime
     */
    private $newsletterUpdatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNewsletterMail(): ?string
    {
        return $this->newsletterMail;
    }

    public function setNewsletterMail(string $newsletterMail): self
    {
        $this->newsletterMail = $newsletterMail;
        $this->newsletterUpdatedAt = new \DateTime('now');

        return $this;
    }
}
