<?php

namespace App\Entity;

use App\Repository\TypehmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypehmRepository::class)
 */
class Typehm
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @var string
     */
    private $typehmNom;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="typehm")
     * 
     */
    private $produits;

    /**
     * @ORM\OneToMany(targetEntity=Categories::class, mappedBy="catTypehm")
     */
    private $categories;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypehmNom(): ?string
    {
        return $this->typehmNom;
    }

    public function setTypehmNom(string $typehmNom): self
    {
        $this->typehmNom = $typehmNom;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setTypehm($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getTypehm() === $this) {
                $produit->setTypehm(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Categories[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categories $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setCatTypehm($this);
        }

        return $this;
    }

    public function removeCategory(Categories $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getCatTypehm() === $this) {
                $category->setCatTypehm(null);
            }
        }

        return $this;
    }
}
