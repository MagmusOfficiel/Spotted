<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use App\Entity\CommandeDetails;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Table(name: 'Commande')]
#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity: Utilisateur::class, inversedBy: "commande")]
    #[ORM\JoinColumn(nullable: false)]
    private Utilisateur $utilisateur;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTime $createdAt;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $transporteurNom;

    #[ORM\Column(type: Types::FLOAT)]
    private float $transporteurPrix;

    #[ORM\Column(type: Types::TEXT)]
    private string $livraison;

    #[ORM\OneToMany(targetEntity:CommandeDetails::class, mappedBy:"maCommande")]
    private CommandeDetails $commandeDetails;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $reference;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private string $stripeSessionId;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $isPaye;

    public function __construct()
    {
        $this->commandeDetails = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTotal() . $this->getTransporteurNom() . $this->getTransporteurPrix() . $this->getLivraison() . $this->getPaye();
    }

    public function getTotal()
    {
        $total = null;
        foreach ($this->getCommandeDetails()->getValues() as $produits) {
            $total = $total + ($produits->getPrix() * $produits->getQuantite());
        }
        return $total;
    }

    public function getQuantite()
    {
        $quantite = null;
        foreach ($this->getCommandeDetails()->getValues() as $produits) {
            $quantite = $produits->getQuantite();
        }
        return $quantite;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getTransporteurNom(): ?string
    {
        return $this->transporteurNom;
    }

    public function setTransporteurNom(string $transporteurNom): self
    {
        $this->transporteurNom = $transporteurNom;

        return $this;
    }

    public function getTransporteurPrix(): ?float
    {
        return $this->transporteurPrix;
    }

    public function setTransporteurPrix(float $transporteurPrix): self
    {
        $this->transporteurPrix = $transporteurPrix;

        return $this;
    }

    public function getLivraison(): ?string
    {
        return $this->livraison;
    }

    public function setLivraison(string $livraison): self
    {
        $this->livraison = $livraison;

        return $this;
    }

    /**
     * @return Collection|CommandeDetails[]
     */
    public function getCommandeDetails(): Collection
    {
        return $this->commandeDetails;
    }

    public function addCommandeDetails(CommandeDetails $commandeDetails): self
    {
        if (!$this->commandeDetails->contains($commandeDetails)) {
            $this->commandeDetails[] = $commandeDetails;
            $commandeDetails->setMaCommande($this);
        }

        return $this;
    }

    public function removeCommandeDetails(CommandeDetails $commandeDetails): self
    {
        if ($this->commandeDetails->removeElement($commandeDetails)) {
            // set the owning side to null (unless already changed)
            if ($commandeDetails->getMaCommande() === $this) {
                $commandeDetails->setMaCommande(null);
            }
        }

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getStripeSessionId(): ?string
    {
        return $this->stripeSessionId;
    }

    public function setStripeSessionId(?string $stripeSessionId): self
    {
        $this->stripeSessionId = $stripeSessionId;

        return $this;
    }

    public function getIsPaye(): ?bool
    {
        return $this->isPaye;
    }

    public function setIsPaye(bool $isPaye): self
    {
        $this->isPaye = $isPaye;

        return $this;
    }
}
