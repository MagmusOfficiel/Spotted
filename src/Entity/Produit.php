<?php

namespace App\Entity;


use App\Entity\ProduitImage;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gedmo\Sluggable\Util\Urlizer;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 * @ORM\Table(name="Produit")
 */
class Produit
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
     * 
     * @ORM\Column(type="string", length=255)
     * 
     * @var string
     */
    private $produitRef;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @var string
     */
    private $produitLibelle;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @var string
     */
    private $produitDescription;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     * 
     * @var string
     */
    private $produitPrix;

    /**
     * @ORM\Column(type="integer")
     * 
     * @var integer
     */
    private $produitStock;

    /**
     * @ORM\Column(type="boolean")
     * 
     * @var boolean
     */
    private $produitBloque;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity=Typehm::class, inversedBy="produits")
     */
    private $typehm;

    /**
     * @ORM\ManyToOne(targetEntity=Marque::class, inversedBy="produits")
     */
    private $marques;

    /**
     * @ORM\ManyToOne(targetEntity=Couleur::class, inversedBy="produits")
     */
    private $couleur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProduitImage", mappedBy="produit", cascade={"persist"})
     */
    private $produitImages;

    /**
     * @ORM\Column(type="date")
     */
    private $produitCreation;

    /**
     * @ORM\Column(type="date")
     */
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

    /**
     * @return Collection|ProduitImage[]
     */
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

    public function getCategorie(): ?Categories
    {
        return $this->categorie;
    }

    public function setCategorie(?Categories $categorie): self
    {
        $this->categorie = $categorie;

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
