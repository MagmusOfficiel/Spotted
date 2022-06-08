<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Table(name: 'Categories')]
#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $catNom;

    #[ORM\OneToMany(targetEntity:Produit::class, mappedBy:"categories")]
    private Collection $produits;

    #[ORM\OneToMany(targetEntity:SousCategories::class, mappedBy:"sousCatCat",orphanRemoval:true)]
    private Collection $sousCategories;

    #[ORM\ManyToOne(targetEntity:Eshop::class, inversedBy:"categories")]
    private Eshop $catEshop;

    #[ORM\ManyToOne(targetEntity:Typehm::class, inversedBy:"categories")]
    private Typehm $catTypehm;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->sousCategories = new ArrayCollection();
    }

    public function __toString()
    {    
        return $this->catNom; 
    } 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCatNom(): ?string
    {
        return $this->catNom;
    }

    public function setCatNom(string $catNom): self
    {
        $this->catNom = $catNom;

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
            $produit->setCategorie($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getCategorie() === $this) {
                $produit->setCategorie(null);
            }
        }

        return $this;
    }



    /**
     * @return Collection|SousCategories[]
     */
    public function getSousCategories(): Collection
    {
        return $this->sousCategories;
    }

    public function addSousCategory(SousCategories $sousCategory): self
    {
        if (!$this->sousCategories->contains($sousCategory)) {
            $this->sousCategories[] = $sousCategory;
            $sousCategory->setSousCatCat($this);
        }

        return $this;
    }

    public function removeSousCategory(SousCategories $sousCategory): self
    {
        if ($this->sousCategories->removeElement($sousCategory)) {
            // set the owning side to null (unless already changed)
            if ($sousCategory->getSousCatCat() === $this) {
                $sousCategory->setSousCatCat(null);
            }
        }

        return $this;
    }

    public function getCatEshop(): ?Eshop
    {
        return $this->catEshop;
    }

    public function setCatEshop(?Eshop $catEshop): self
    {
        $this->catEshop = $catEshop;

        return $this;
    }

    public function getCatTypehm(): ?Typehm
    {
        return $this->catTypehm;
    }

    public function setCatTypehm(?Typehm $catTypehm): self
    {
        $this->catTypehm = $catTypehm;

        return $this;
    }
}
