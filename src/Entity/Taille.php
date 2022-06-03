<?php

namespace App\Entity;

use App\Repository\TailleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TailleRepository::class)
 */
class Taille
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
    private $valeur;

    /**
     * @ORM\OneToOne(targetEntity=Attributs::class, mappedBy="taille", cascade={"persist", "remove"})
     */
    private $attributs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValeur(): ?string
    {
        return $this->valeur;
    }

    public function setValeur(string $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function getAttributs(): ?Attributs
    {
        return $this->attributs;
    }

    public function setAttributs(?Attributs $attributs): self
    {
        // unset the owning side of the relation if necessary
        if ($attributs === null && $this->attributs !== null) {
            $this->attributs->setTaille(null);
        }

        // set the owning side of the relation if necessary
        if ($attributs !== null && $attributs->getTaille() !== $this) {
            $attributs->setTaille($this);
        }

        $this->attributs = $attributs;

        return $this;
    }
}
