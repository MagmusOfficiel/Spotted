<?php

namespace App\Entity;

use App\Repository\AttributsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AttributsRepository::class)
 */
class Attributs
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
    private $AttributNom;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAttributNom(): ?string
    {
        return $this->AttributNom;
    }

    public function setAttributNom(string $AttributNom): self
    {
        $this->AttributNom = $AttributNom;

        return $this;
    }
}
