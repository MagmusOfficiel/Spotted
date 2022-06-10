<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM; 
use App\Repository\ReseauxRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Table(name: 'Reseaux')]
#[ORM\Entity(repositoryClass: ReseauxRepository::class)]
#[Vich\Uploadable]
class Reseaux
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $reseauNom;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $reseauEntier = '';

    #[ORM\Column(type: Types::DATETIME_MUTABLE,nullable:true)]
    private $reseauUpdatedAt;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $reseauDestination;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $reseauLien;

    #[Vich\UploadableField(mapping:"reseaux", fileNameProperty:"reseauEntier")]
    private File $imageFile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReseauNom(): ?string
    {
        return $this->reseauNom;
    }

    public function setReseauNom(string $reseauNom): self
    {
        $this->reseauNom = $reseauNom;

        return $this;
    }

    public function getReseauEntier(): ?string
    {
        return $this->reseauEntier;
    }

    public function setReseauEntier(?string $reseauEntier): self
    {
        $this->reseauEntier = $reseauEntier;

        return $this;
    }

    public function getReseauDestination(): ?string
    {
        return $this->reseauDestination;
    }

    public function setReseauDestination(string $reseauDestination): self
    {
        $this->reseauDestination = $reseauDestination;

        return $this;
    }

    public function getReseauLien(): ?string
    {
        return $this->reseauLien;
    }

    public function setReseauLien(string $reseauLien): self
    {
        $this->reseauLien = $reseauLien;

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
            $this->reseauUpdatedAt = new DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
}
