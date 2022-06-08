<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PointsRepository;

#[ORM\Table(name: 'Points')]
#[ORM\Entity(repositoryClass: PointsRepository::class)]
class Points
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private int $NbrPoints;

    #[ORM\OneToOne(targetEntity: Utilisateur::class, inversedBy: "points", cascade: ["persist", "remove"])]
    private Utilisateur $UserPoints;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTime $createdAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTime $dateExpiration;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrPoints(): ?int
    {
        return $this->NbrPoints;
    }

    public function setNbrPoints(int $NbrPoints): self
    {
        $this->NbrPoints = $NbrPoints;

        return $this;
    }

    public function getUserPoints(): ?Utilisateur
    {
        return $this->UserPoints;
    }

    public function setUserPoints(?Utilisateur $UserPoints): self
    {
        $this->UserPoints = $UserPoints;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDateExpiration(): ?\DateTimeInterface
    {
        return $this->dateExpiration;
    }

    public function setDateExpiration(\DateTimeInterface $dateExpiration): self
    {
        $this->dateExpiration = $dateExpiration;

        return $this;
    }
}
