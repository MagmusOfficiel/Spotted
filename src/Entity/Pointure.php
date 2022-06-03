<?php

namespace App\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PointureRepository;

/**
 * @ORM\Entity(repositoryClass=PointureRepository::class)
 */
class Pointure
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
     * @ORM\Column(type="integer", length=255)
     * 
     * @var integer
     */
    private $valeur;


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

}
