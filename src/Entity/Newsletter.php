<?php

namespace App\Entity;
 
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\NewsletterRepository;

#[ORM\Table(name: 'Newsletter')]
#[ORM\Entity(repositoryClass: NewsletterRepository::class)]
class Newsletter
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $newsletterMail;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable:true)]
    private \DateTime $newsletterUpdatedAt;

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
