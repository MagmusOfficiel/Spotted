<?php

namespace App\Entity;

use DateTime;
use DateTimeImmutable; 
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CarrouselRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=CarrouselRepository::class)
 * @Vich\Uploadable
 */
class Carrousel
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
    private $carrouselTitre;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @var string
     */
    private $carrouselDescription;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @var string
     */
    private $carrouselDestination;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @var string
     */
    private $carrouselEntier;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @var string
     */
    private $carrouselNom;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $carrouselUpdatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @var string
     */
    private $carrouselSize;

        /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="carrousel", fileNameProperty="carrouselEntier", size="carrouselSize")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="integer")
     */
    private $carrouselPosition;


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
