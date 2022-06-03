<?php

namespace App\Entity;

use App\Repository\TransporteurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TransporteurRepository::class)
 */
class Transporteur
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
    private $transporteurNom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $transporteurDescription;

    /**
     * @ORM\Column(type="float")
     */
    private $transporteurPrix;

    public function __toString()
    {
        return $this->getTransporteurNom().'[br]'.$this->getTransporteurDescription().'[br]'.number_format($this->getTransporteurPrix(), 2, ',',',').' €';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTransporteurNom(): ?string
    {
        return $this->transporteurNom;
    }

    public function setTransporteurNom(string $transporteurNom): self
    {
        $this->transporteurNom = $transporteurNom;

        return $this;
    }

    public function getTransporteurDescription(): ?string
    {
        return $this->transporteurDescription;
    }

    public function setTransporteurDescription(string $transporteurDescription): self
    {
        $this->transporteurDescription = $transporteurDescription;

        return $this;
    }

    public function getTransporteurPrix(): ?float
    {
        return $this->transporteurPrix;
    }

    public function setTransporteurPrix(float $transporteurPrix): self
    {
        $this->transporteurPrix = $transporteurPrix;

        return $this;
    }
}
