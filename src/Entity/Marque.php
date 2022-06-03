<?php

namespace App\Entity;

 
use Doctrine\ORM\Mapping as ORM;  
use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich; 
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=MarqueRepository::class)
 * @Vich\Uploadable
 */
class Marque
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
    private $marqueNom;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="marques")
     */
    private $produits;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @var string
     */
    private $marqueLogo;

    /**
     * @Vich\UploadableField(mapping="marques", fileNameProperty="marqueLogo")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * 
     * @var \Datetime
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marqueDestination;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getMarqueNom(): ?string
    {
        return $this->marqueNom;
    }

    public function setMarqueNom(string $marqueNom): self
    {
        $this->marqueNom = $marqueNom;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setMarques($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getMarques() === $this) {
                $produit->setMarques(null);
            }
        }

        return $this;
    }

    public function getMarqueLogo(): ?string
    {
        return $this->marqueLogo;
    }

    public function setMarqueLogo(?string $marqueLogo): self
    {
        $this->marqueLogo = $marqueLogo;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getMarqueDestination(): ?string
    {
        return $this->marqueDestination;
    }

    public function setMarqueDestination(string $marqueDestination): self
    {
        $this->marqueDestination = $marqueDestination;

        return $this;
    }
}
