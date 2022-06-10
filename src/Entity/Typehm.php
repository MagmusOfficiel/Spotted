<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TypehmRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Table(name: 'Typehm')]
#[ORM\Entity(repositoryClass: TypehmRepository::class)]
class Typehm
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $typehmNom;

    #[ORM\OneToMany(targetEntity:Produit::class, mappedBy:"typehm")]
    private Collection $produits;

    #[ORM\OneToMany(targetEntity:Categories::class, mappedBy:"catTypehm")]
    private Collection $categories;

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
