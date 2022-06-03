<?php

namespace App\Entity;

use App\Repository\SousCategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SousCategoriesRepository::class)
 */
class SousCategories
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
    private $sousCatNom;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="sousCategories")
     */
    private $sousCatCat;

    /**
     * @ORM\OneToMany(targetEntity=SousSousCategories::class, mappedBy="sousCat",orphanRemoval=true)
     */
    private $sousSousCategories;

    public function __construct()
    {
        $this->sousSousCategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSousCatNom(): ?string
    {
        return $this->sousCatNom;
    }

    public function setSousCatNom(string $sousCatNom): self
    {
        $this->sousCatNom = $sousCatNom;

        return $this;
    }

    public function getSousCatCat(): ?Categories
    {
        return $this->sousCatCat;
    }

    public function setSousCatCat(?Categories $sousCatCat): self
    {
        $this->sousCatCat = $sousCatCat;

        return $this;
    }

    /**
     * @return Collection|SousSousCategorie[]
     */
    public function getSousSousCategories(): Collection
    {
        return $this->sousSousCategories;
    }

    public function addSousSousCategory(SousSousCategories $sousSousCategory): self
    {
        if (!$this->sousSousCategories->contains($sousSousCategory)) {
            $this->sousSousCategories[] = $sousSousCategory;
            $sousSousCategory->setSousCat($this);
        }

        return $this;
    }

    public function removeSousSousCategory(SousSousCategories $sousSousCategory): self
    {
        if ($this->sousSousCategories->removeElement($sousSousCategory)) {
            // set the owning side to null (unless already changed)
            if ($sousSousCategory->getSousCat() === $this) {
                $sousSousCategory->setSousCat(null);
            }
        }

        return $this;
    }
}
