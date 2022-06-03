<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CouleurRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=CouleurRepository::class)
 */
class Couleur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @var string
     */
    private $couleurNom;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="couleur")
     */
    private $produits;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $couleurValeur;


    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCouleurNom(): ?string
    {
        return $this->couleurNom;
    }

    public function setCouleurNom(string $couleurNom): self
    {
        $this->couleurNom = $couleurNom;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduits(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setCouleur($this);
        }

        return $this;
    }

    public function removeProduits(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getCouleur() === $this) {
                $produit->setCouleur(null);
            }
        }

        return $this;
    }

    public function getCouleurValeur(): ?string
    {
        return $this->couleurValeur;
    }

    public function setCouleurValeur(string $couleurValeur): self
    {
        $this->couleurValeur = $couleurValeur;

        return $this;
    }
}
