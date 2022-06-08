<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AttributsRepository;

#[ORM\Table(name: 'Attributs')]
#[ORM\Entity(repositoryClass: AttributsRepository::class)]
class Attributs
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $attributNom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAttributNom(): ?string
    {
        return $this->attributNom;
    }

    public function setAttributNom(string $attributNom): self
    {
        $this->attributNom = $attributNom;

        return $this;
    }
}
