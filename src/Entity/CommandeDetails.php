<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandeDetailsRepository;

#[ORM\Table(name: 'CommandeDetails')]
#[ORM\Entity(repositoryClass: CommandeDetailsRepository::class)]
class CommandeDetails
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity:Commande::class, inversedBy:"commandeDetails")]
    #[ORM\JoinColumn(nullable:false)]
    private Commande $maCommande;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $produits;

    #[ORM\Column(type: Types::INTEGER)]
    private int $quantite;

    #[ORM\Column(type: Types::FLOAT)]
    private float $prix;

    #[ORM\Column(type: Types::FLOAT)]
    private float $total;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaCommande(): ?Commande
    {
        return $this->maCommande;
    }

    public function setMaCommande(?Commande $maCommande): self
    {
        $this->maCommande = $maCommande;

        return $this;
    }

    public function getProduits(): ?string
    {
        return $this->produits;
    }

    public function setProduits(string $produits): self
    {
        $this->produits = $produits;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }
}
