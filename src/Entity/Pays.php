<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PaysRepository;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich; 

/**
 * @ORM\Entity(repositoryClass=PaysRepository::class)
 * @Vich\Uploadable
 */
class Pays
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $paysNom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $paysDrapeau;

        /**
     * @Vich\UploadableField(mapping="pays", fileNameProperty="paysDrapeau")
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
    private $paysDestination;

    /**
     * @ORM\OneToMany(targetEntity=Utilisateur::class, mappedBy="userNationalite")
     */
    private $utilisateurs;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaysNom(): ?string
    {
        return $this->paysNom;
    }

    public function setPaysNom(string $paysNom): self
    {
        $this->paysNom = $paysNom;

        return $this;
    }

    public function getPaysDrapeau(): ?string
    {
        return $this->paysDrapeau;
    }

    public function setPaysDrapeau(?string $paysDrapeau): self
    {
        $this->paysDrapeau = $paysDrapeau;

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

    public function getPaysDestination(): ?string
    {
        return $this->paysDestination;
    }

    public function setPaysDestination(string $paysDestination): self
    {
        $this->paysDestination = $paysDestination;

        return $this;
    }

    /**
     * @return Collection|Utilisateur[]
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): self
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs[] = $utilisateur;
            $utilisateur->setUserNationalite($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): self
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            // set the owning side to null (unless already changed)
            if ($utilisateur->getUserNationalite() === $this) {
                $utilisateur->setUserNationalite(null);
            }
        }

        return $this;
    }
}
