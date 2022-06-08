<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TransporteurRepository;

#[ORM\Table(name: 'Transporteur')]
#[ORM\Entity(repositoryClass: TransporteurRepository::class)]
class Transporteur
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $transporteurNom;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $transporteurDescription;

    #[ORM\Column(type: Types::FLOAT)]
    private float $transporteurPrix;

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
