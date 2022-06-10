<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ThemeImageRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Table(name: 'ThemeImage')]
#[ORM\Entity(repositoryClass: ThemeImageRepository::class)]
#[Vich\Uploadable]
class ThemeImage
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $imageNom;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $imageEntier;

    #[Vich\UploadableField(mapping:"themeimage", fileNameProperty:"imageEntier")]
    private ?File $imageFile = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE,nullable:true)]
    private  $updatedAt;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $imageDestination;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageNom(): ?string
    {
        return $this->imageNom;
    }

    public function setImageNom(?string $imageNom): self
    {
        $this->imageNom = $imageNom;

        return $this;
    }

    public function getImageEntier(): ?string
    {
        return $this->imageEntier;
    }

    public function setImageEntier(?string $imageEntier): self
    {
        $this->imageEntier = $imageEntier;

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
            $this->updatedAt= new \DateTime('now');
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getImageDestination(): ?string
    {
        return $this->imageDestination;
    }

    public function setImageDestination(string $imageDestination): self
    {
        $this->imageDestination = $imageDestination;

        return $this;
    }
}
