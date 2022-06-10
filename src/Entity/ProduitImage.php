<?php

namespace App\Entity;

use DateTimeImmutable; 
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Table(name: 'ProduitImage')]
#[ORM\Entity(repositoryClass: ProduitImageRepository::class)]
#[Vich\Uploadable]
class ProduitImage
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity:Produit::class, inversedBy:"produitImages",cascade:["persist"])]
    private Produit $produit;

    #[ORM\Column(type: Types::STRING, length: 255, nullable:true)]
    private string $imageName;

    #[ORM\Column(type: Types::STRING, length: 255, nullable:true)]
    private string $imageSize;
    
    #[Vich\UploadableField(mapping:"default", fileNameProperty:"imageName", size:"imageSize")]
    private File $imageFile;

    #[ORM\Column(type: Types::DATETIME_MUTABLE,nullable:true)] 
    private  $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getImageSize(): ?string
    {
        return $this->imageSize;
    }

    public function setImageSize(?string $imageSize): self
    {
        $this->imageSize = $imageSize;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile
     * @throws \Exception
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
}