<?php

namespace App\Entity;

use App\Entity\ProduitImage;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Table(name: 'Produit')]
#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $produitRef;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $produitLibelle;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $produitDescription;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 2)]
    private string $produitPrix;

    #[ORM\Column(type: Types::INTEGER)]
    private int $produitStock;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $produitBloque;

    #[ORM\ManyToOne(targetEntity: Categories::class, inversedBy: "produits")]
    #[ORM\JoinColumn(nullable: false)]
    private Categories $categories;

    #[ORM\ManyToOne(targetEntity: Typehm::class, inversedBy: "produits")]
    private Typehm $typehm;

    #[ORM\ManyToOne(targetEntity: Marque::class, inversedBy: "produits")]
    private Marque $marques;

    #[ORM\ManyToOne(targetEntity: Couleur::class, inversedBy: "produits")]
    private Couleur $couleur;

    #[ORM\OneToMany(targetEntity: ProduitImage::class, mappedBy: "produit", cascade: ["persist"])]
    private Collection $produitImages;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private $produitCreation;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private $produitNouveaute;


    public function __construct()
    {
        $this->produitImages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getProduitRef(): ?string
    {
        return $this->produitRef;
    }

    public function setProduitRef(string $produitRef): self
    {
        $this->produitRef = $produitRef;

        return $this;
    }

    public function getProduitLibelle(): ?string
    {
        return $this->produitLibelle;
    }

    public function setProduitLibelle(string $produitLibelle): self
    {
        $this->produitLibelle = $produitLibelle;

        return $this;
    }

    public function getProduitDescription(): ?string
    {
        return $this->produitDescription;
    }

    public function setProduitDescription(string $produitDescription): self
    {
        $this->produitDescription = $produitDescription;

        return $this;
    }

    public function getProduitPrix(): ?string
    {
        return $this->produitPrix;
    }

    public function setProduitPrix(string $produitPrix): self
    {
        $this->produitPrix = $produitPrix;

        return $this;
    }

    public function getProduitStock(): ?int
    {
        return $this->produitStock;
    }

    public function setProduitStock(int $produitStock): self
    {
        $this->produitStock = $produitStock;

        return $this;
    }

    public function getProduitImages(): Collection
    {
        return $this->produitImages;
    }

    public function addProduitImage(ProduitImage $produitImage): self
    {
        if (!$this->produitImages->contains($produitImage)) {
            $this->produitImages[] = $produitImage;
            $produitImage->setProduit($this);
        }


        return $this;
    }

    public function removeProduitImage(ProduitImage $produitImage): self
    {
        if ($this->produitImages->contains($produitImage)) {
            $this->produitImages->removeElement($produitImage);
            // set the owning side to null (unless already changed)
            if ($produitImage->getProduit() === $this) {
                $produitImage->setProduit(null);
            }
        }

        return $this;
    }


    public function getProduitBloque(): ?int
    {
        return $this->produitBloque;
    }

    public function setProduitBloque(int $produitBloque): self
    {
        $this->produitBloque = $produitBloque;

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

    public function getTypehm(): ?Typehm
    {
        return $this->typehm;
    }

    public function setTypehm(?Typehm $typehm): self
    {
        $this->typehm = $typehm;

        return $this;
    }

    public function getMarques(): ?Marque
    {
        return $this->marques;
    }

    public function setMarques(?Marque $marques): self
    {
        $this->marques = $marques;

        return $this;
    }

    public function getCouleur(): ?Couleur
    {
        return $this->couleur;
    }

    public function setCouleur(?Couleur $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getProduitCreation(): ?\DateTimeInterface
    {

        return $this->produitCreation;
    }

    public function setProduitCreation(\DateTimeInterface $produitCreation): self
    {
        $this->produitCreation = $produitCreation;

        return $this;
    }

    public function getProduitNouveaute(): ?\DateTimeInterface
    {
        return $this->produitNouveaute;
    }

    public function setProduitNouveaute(\DateTimeInterface $produitNouveaute): self
    {
        $this->produitNouveaute = $produitNouveaute;

        return $this;
    }
}
