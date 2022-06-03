<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
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
    private $catNom;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="categorie")
     */
    private $produits;


    /**
     * @ORM\OneToMany(targetEntity=SousCategories::class, mappedBy="sousCatCat",orphanRemoval=true)
     */
    private $sousCategories;

    /**
     * @ORM\ManyToOne(targetEntity=Eshop::class, inversedBy="categories")
     */
    private $catEshop;

    /**
     * @ORM\ManyToOne(targetEntity=Typehm::class, inversedBy="categories")
     */
    private $catTypehm;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->sousCategories = new ArrayCollection();
    }

    public function __toString()
    {
        // Or change the property that you want to show in the select.
         
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
