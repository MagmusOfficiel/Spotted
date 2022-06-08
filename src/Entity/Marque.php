<?php

namespace App\Entity;

 
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;  
use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich; 
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Table(name: 'Marque')]
#[ORM\Entity(repositoryClass: MarqueRepository::class)]
#[Vich\Uploadable]
class Marque
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $marqueNom;

    #[ORM\OneToMany(targetEntity:Produit::class, mappedBy:"marques")]
    private Collection $produits;

    #[ORM\Column(type: Types::STRING, length: 255, nullable:true)]
    private string $marqueLogo;

    #[Vich\UploadableField(mapping:"marques", fileNameProperty:"marqueLogo")]
    private File $imageFile;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable:true)]
    private \DateTime $updatedAt;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $marqueDestination;

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
