<?php

namespace App\Entity;

use App\Repository\SousSousCategoriesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SousSousCategoriesRepository::class)
 */
class SousSousCategories
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
    private $sousSousCatNom;

    /**
     * @ORM\ManyToOne(targetEntity=SousCategories::class, inversedBy="sousSousCategories")
     */
    private $sousCat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSousSousCatNom(): ?string
    {
        return $this->sousSousCatNom;
    }

    public function setSousSousCatNom(string $sousSousCatNom): self
    {
        $this->sousSousCatNom = $sousSousCatNom;

        return $this;
    }

    public function getSousCat(): ?SousCategories
    {
        return $this->sousCat;
    }

    public function setSousCat(?SousCategories $sousCat): self
    {
        $this->sousCat = $sousCat;

        return $this;
    }
}
