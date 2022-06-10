<?php

namespace App\Entity;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CarrouselRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Table(name: 'Carrousel')]
#[ORM\Entity(repositoryClass: CarrouselRepository::class)]
#[Vich\Uploadable]
class Carrousel
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $carrouselTitre;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $carrouselDescription;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $carrouselDestination;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $carrouselEntier;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $carrouselNom;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private \DateTime $carrouselUpdatedAt;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $carrouselSize;

     #[Vich\UploadableField(mapping:"carrousel", fileNameProperty:"carrouselEntier", size:"carrouselSize")]
    private ?File $imageFile = null;

    #[ORM\Column(type: Types::INTEGER)]
    private int $carrouselPosition;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarrouselTitre(): ?string
    {
        return $this->carrouselTitre;
    }

    public function setCarrouselTitre(string $carrouselTitre): self
    {
        $this->carrouselTitre = $carrouselTitre;

        return $this;
    }

    public function getCarrouselDescription(): ?string
    {
        return $this->carrouselDescription;
    }

    public function setCarrouselDescription(string $carrouselDescription): self
    {
        $this->carrouselDescription = $carrouselDescription;

        return $this;
    }

    public function getCarrouselDestination(): ?string
    {
        return $this->carrouselDestination;
    }

    public function setCarrouselDestination(string $carrouselDestination): self
    {
        $this->carrouselDestination = $carrouselDestination;

        return $this;
    }

    public function getCarrouselEntier(): ?string
    {
        return $this->carrouselEntier;
    }

    public function setCarrouselEntier(string $carrouselEntier): self
    {
        $this->carrouselEntier = $carrouselEntier;

        return $this;
    }

    public function getCarrouselNom(): ?string
    {
        return $this->carrouselNom;
    }

    public function setCarrouselNom(string $carrouselNom): self
    {
        $this->carrouselNom = $carrouselNom;

        return $this;
    }

    public function getCarrouselSize(): ?string
    {
        return $this->carrouselSize;
    }

    public function setCarrouselSize(string $carrouselSize): self
    {
        $this->carrouselSize = $carrouselSize;

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
        
        if($this->imageFile instanceof UploadedFile){
            $this->carrouselUpdatedAt= new \DateTime('now');
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getCarrouselPosition(): ?int
    {
        return $this->carrouselPosition;
    }

    public function setCarrouselPosition(int $carrouselPosition): self
    {
        $this->carrouselPosition = $carrouselPosition;

        return $this;
    }
}
