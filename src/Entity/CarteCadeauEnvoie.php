<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CarteCadeauEnvoieRepository;

#[ORM\Table(name: 'cartecadeauenvoie')]
#[ORM\Entity(repositoryClass: CarteCadeauEnvoieRepository::class)]
class CarteCadeauEnvoie
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 0)]
    private float $carteMontant;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $cartePrenom;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $carteNom;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $carteEmail;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $carteEmailVerif;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \Datetime $carteDate;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $carteMessage;

    #[ORM\ManyToOne(targetEntity: CarteCadeau::class, inversedBy: "carteCadeauEnvoie", cascade: "persist")]
    private CarteCadeau $carteTheme;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarteMontant(): ?string
    {
        return $this->carteMontant;
    }

    public function setCarteMontant(string $carteMontant): self
    {
        $this->carteMontant = $carteMontant;

        return $this;
    }

    public function getCartePrenom(): ?string
    {
        return $this->cartePrenom;
    }

    public function setCartePrenom(string $cartePrenom): self
    {
        $this->cartePrenom = $cartePrenom;

        return $this;
    }

    public function getCarteNom(): ?string
    {
        return $this->carteNom;
    }

    public function setCarteNom(string $carteNom): self
    {
        $this->carteNom = $carteNom;

        return $this;
    }

    public function getCarteEmail(): ?string
    {
        return $this->carteEmail;
    }

    public function setCarteEmail(string $carteEmail): self
    {
        $this->carteEmail = $carteEmail;

        return $this;
    }

    public function getCarteEmailVerif(): ?string
    {
        return $this->carteEmailVerif;
    }

    public function setCarteEmailVerif(string $carteEmailVerif): self
    {
        $this->carteEmailVerif = $carteEmailVerif;

        return $this;
    }

    public function getCarteDate(): ?\DateTimeInterface
    {
        return $this->carteDate;
    }

    public function setCarteDate(\DateTimeInterface $carteDate): self
    {
        $this->carteDate = $carteDate;

        return $this;
    }

    public function getCarteMessage(): ?string
    {
        return $this->carteMessage;
    }

    public function setCarteMessage(string $carteMessage): self
    {
        $this->carteMessage = $carteMessage;

        return $this;
    }


    public function getCarteTheme(): ?CarteCadeau
    {
        return $this->carteTheme;
    }

    public function setCarteTheme(?CarteCadeau $carteTheme): self
    {
        $this->carteTheme = $carteTheme;

        return $this;
    }

}
