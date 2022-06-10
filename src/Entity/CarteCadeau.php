<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CarteCadeauRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;
 
#[ORM\Table(name: 'CarteCadeau')]
#[ORM\Entity(repositoryClass: CarteCadeauRepository::class)]
#[Vich\Uploadable]
class CarteCadeau
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $cartecadeauRef;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string  $cartecadeauLibelle;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string  $cartecadeauDescription;

    #[ORM\Column(type: Types::BOOLEAN)]
    private int $cartecadeauBloque;

    #[ORM\ManyToOne(targetEntity:Categories::class, inversedBy:"cartecadeau")]
    private Categories $categories;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private $cartecadeauCreation;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private $cartecadeauNouveaute;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $cartecadeauImage;

    #[Vich\UploadableField(mapping:"cartecadeau", fileNameProperty:"cartecadeauImage")]
    private $imageFile;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\Datetime $updatedAt;

    #[ORM\OneToMany(targetEntity:CarteCadeauEnvoie::class, mappedBy:"carteTheme", cascade:["persist"])]
    private Collection $carteCadeauEnvoie;

    public function __construct()
    {
        $this->carteCadeauEnvoie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarteCadeauRef(): ?string
    {
        return $this->cartecadeauRef;
    }

    public function setCarteCadeauRef(string $cartecadeauRef): self
    {
        $this->cartecadeauRef = $cartecadeauRef;

        return $this;
    }
  
    public function getCarteCadeauLibelle(): ?string
    {
        return $this->cartecadeauLibelle;
    }

    public function setCarteCadeauLibelle(string $cartecadeauLibelle): self
    {
        $this->cartecadeauLibelle = $cartecadeauLibelle;

        return $this;
    }

    public function getCarteCadeauDescription(): ?string
    {
        return $this->cartecadeauDescription;
    }

    public function setCarteCadeauDescription(string $cartecadeauDescription): self
    {
        $this->cartecadeauDescription = $cartecadeauDescription;

        return $this;
    }


    public function getCarteCadeauBloque(): ?int
    {
        return $this->cartecadeauBloque;
    }

    public function setCarteCadeauBloque(int $cartecadeauBloque): self
    {
        $this->cartecadeauBloque = $cartecadeauBloque;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }


    public function getCarteCadeauCreation(): ?\DateTimeInterface
    {
 
        return $this->cartecadeauCreation;
    }

    public function setCarteCadeauCreation(\DateTimeInterface $cartecadeauCreation): self
    {
        $this->cartecadeauCreation = $cartecadeauCreation;

        return $this;
    }

    public function getCarteCadeauNouveaute(): ?\DateTimeInterface
    {
        return $this->cartecadeauNouveaute;
    }

    public function setCarteCadeauNouveaute(\DateTimeInterface $cartecadeauNouveaute): self
    {
        $this->cartecadeauNouveaute = $cartecadeauNouveaute;

        return $this;
    }


    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }


    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if($this->imageFile instanceof UploadedFile){
            $this->updatedAt= new \DateTime('now');
        }
    }

    public function getCarteCadeauImage(): ?string
    {
        return $this->cartecadeauImage;
    }

    public function setCarteCadeauImage(?string $cartecadeauImage): self
    {
        $this->cartecadeauImage = $cartecadeauImage;

        return $this;
    }

    public function getCarteCadeauEnvoie(): ?CarteCadeauEnvoie
    {
        return $this->carteCadeauEnvoie;
    }

    public function setCarteCadeauEnvoie(CarteCadeauEnvoie $carteCadeauEnvoie): self
    {
        // unset the owning side of the relation if necessary
        if ($carteCadeauEnvoie === null && $this->carteCadeauEnvoie !== null) {
            $this->carteCadeauEnvoie->setCarteTheme(null);
        }

        // set the owning side of the relation if necessary
        if ($carteCadeauEnvoie !== null && $carteCadeauEnvoie->getCarteTheme() !== $this) {
            $carteCadeauEnvoie->setCarteTheme($this);
        }

        $this->carteCadeauEnvoie = $carteCadeauEnvoie;

        return $this;
    }
}
