<?php

namespace App\Entity;

use App\Repository\PointsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PointsRepository::class)
 */
class Points
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $NbrPoints;

    /**
     * @ORM\OneToOne(targetEntity=Utilisateur::class, inversedBy="points", cascade={"persist", "remove"})
     */
    private $UserPoints;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateExpiration;

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
