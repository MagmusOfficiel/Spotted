<?php

namespace App\Entity;

use App\Entity\Pays;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass:UtilisateurRepository::class)]
#[UniqueEntity(fields : ["userMail"],message:"L'adresse e-mail déjà existant")]
class Utilisateur implements UserInterface
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type:"string", length:255)]
    #[Assert\Regex("/^[a-zA-Z\-éèàçùëüïôäâêûîô#&]+$/")]
    private string $username;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $password;

    #[Assert\Regex(pattern: "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/",message: "Il faut un mot de passe de 8 caractères au minimum, au moins une lettre et un chiffre")]
    #[Assert\EqualTo(propertyPath:"password", message:"Les mot de passes ne correspondent pas")]
    private string $verifPassword;

    #[ORM\Column(type:TYPES::ARRAY, length:255)]
    private array $roles;

    #[ORM\Column(type:Types::STRING, length:255)]
    #[Assert\Regex(pattern:"/^[a-zA-Z\-éèàçùëüïôäâêûîô#&]+$/")]
    private string $userPrenom;

    #[ORM\Column(type:Types::STRING, length:255)]
    #[Assert\Regex(pattern:"/^[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,4}$/", message:"L'adresse mail a été mal écris ou n'éxiste pas.")]
    private string $userMail;

    #[ORM\Column(type: TYPES::DATE_MUTABLE)]
    private \DateTimeInterface $userNaissance;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $userSexe;

    #[ORM\ManyToOne(targetEntity:Pays::class, inversedBy:"utilisateurs")]
    private Pays $userNationalite;

    #[ORM\OneToMany(targetEntity:Adresse::class, mappedBy:"user")]
    private Adresse $adresses;

    #[ORM\OneToMany(targetEntity:Commande::class, mappedBy:"user")]
    private Commande $commande;

    #[ORM\OneToOne(targetEntity:Points::class, mappedBy:"UserPoints", cascade:["persist", "remove"])]
    private Points $points;

    public function __construct()
    {
        $this->adresses = new ArrayCollection();
        $this->commande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserIdentifier()
    {
        
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getVerifPassword(): ?string
    {
        return $this->verifPassword;
    }

    public function setVerifPassword(string $verifPassword): self
    {
        $this->verifPassword = $verifPassword;

        return $this;
    }

    public function getRoles(): array
    {
        return [$this->roles];
    }

    public function setRoles(string $role): self
    {
        $this->roles = $role;

        return $this;
    }

    public function getSalt()
    {
    }

    public function eraseCredentials()
    {
    }

    public function getUserPrenom(): ?string
    {
        return $this->userPrenom;
    }

    public function setUserPrenom(string $userPrenom): self
    {
        $this->userPrenom = $userPrenom;

        return $this;
    }

    public function getUserMail(): ?string
    {
        return $this->userMail;
    }

    public function setUserMail(string $userMail): self
    {
        $this->userMail = $userMail;

        return $this;
    }

    public function getUserNaissance(): ?\DateTimeInterface
    {
        return $this->userNaissance;
    }

    public function setUserNaissance(\DateTimeInterface $userNaissance): self
    {
        $this->userNaissance = $userNaissance;

        return $this;
    }

    public function getUserSexe(): ?string
    {
        return $this->userSexe;
    }

    public function setUserSexe(string $userSexe): self
    {
        $this->userSexe = $userSexe;

        return $this;
    }

    public function getUserNationalite(): ?Pays
    {
        return $this->userNationalite;
    }

    public function setUserNationalite(?Pays $userNationalite): self
    {
        $this->userNationalite = $userNationalite;

        return $this;
    }
    /**
     * @return Collection|Adresse[]
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdresse(Adresse $adresse): self
    {
        if (!$this->adresses->contains($adresse)) {
            $this->adresses[] = $adresse;
            $adresse->setUser($this);
        }

        return $this;
    }

    public function removeAdresse(Adresse $adresse): self
    {
        if ($this->adresses->removeElement($adresse)) {
            // set the owning side to null (unless already changed)
            if ($adresse->getUser() === $this) {
                $adresse->setUser(null);
            }
        }

        return $this;
    }

        /**
     * @return Collection|Commande[]
     */
    public function getCommande(): Collection
    {
        return $this->commande;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commande->contains($commande)) {
            $this->commande[] = $commande;
            $commande->setUtilisateur($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commande->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getUtilisateur() === $this) {
                $commande->setUtilisateur(null);
            }
        }

        return $this;
    }

    public function getPoints(): ?Points
    {
        return $this->points;
    }

    public function setPoints(?Points $points): self
    {
        // unset the owning side of the relation if necessary
        if ($points === null && $this->points !== null) {
            $this->points->setUserPoints(null);
        }

        // set the owning side of the relation if necessary
        if ($points !== null && $points->getUserPoints() !== $this) {
            $points->setUserPoints($this);
        }

        $this->points = $points;

        return $this;
    }

}
