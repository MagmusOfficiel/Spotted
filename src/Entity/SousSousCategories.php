<?php

namespace App\Entity;

use App\Repository\SousSousCategoriesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'SousSousCategories')]
#[ORM\Entity(repositoryClass: SousSousCategoriesRepository::class)]
class SousSousCategories
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $sousSousCatNom;

    #[ORM\ManyToOne(targetEntity:SousCategories::class, inversedBy:"sousSousCategories")]
    private SousCategories $sousCat;

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
