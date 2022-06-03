<?php

namespace App\Entity;

use App\Repository\CarteCadeauEnvoieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarteCadeauEnvoieRepository::class)
 */
class CarteCadeauEnvoie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=0)
     */
    private $carteMontant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cartePrenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $carteNom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $carteEmail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $carteEmailVerif;

    /**
     * @ORM\Column(type="datetime")
     */
    private $carteDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $carteMessage;

    /**
     * @ORM\ManyToOne(targetEntity=CarteCadeau::class, inversedBy="carteCadeauEnvoie", cascade={"persist"})
     */
    private $carteTheme;

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
