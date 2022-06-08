<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AdresseRepository;

#[ORM\Table(name: 'Adresse')]
#[ORM\Entity(repositoryClass:AdresseRepository::class)]
class Adresse
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity:Utilisateur::class, inversedBy:"adresses")]
    #[ORM\JoinColumn(nullable:false)]
    private ?Utilisateur $user =null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $name;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $firstname;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $lastname;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $company;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $adress;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $postal;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $city;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $country;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $phone;

    public function __toString()
    {
        return $this->getName().'[br]'.$this->getAddress().'[br]'.$this->getCity().' - '.$this->getCountry();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Utilisateur
    {
        return $this->user;
    }

    public function setUser(?Utilisateur $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->adress;
    }

    public function setAddress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getPostal(): ?string
    {
        return $this->postal;
    }

    public function setPostal(string $postal): self
    {
        $this->postal = $postal;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}
