<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CodePromoRepository;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Table(name: 'CodePromo')]
#[ORM\Entity(repositoryClass: CodePromoRepository::class)]
#[Vich\Uploadable]
class CodePromo
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $codeCode;

    #[ORM\Column(type: Types::INTEGER)]
    private int $codeQuantite;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private float $codeMontant;

    #[ORM\Column(type: Types::INTEGER)]
    private int $codeBloque;

    #[ORM\Column(type: Types::INTEGER)]
    private int $codeType;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private $codeDateCreation;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private $codeDateValide;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeCode(): ?string
    {
        return $this->codeCode;
    }

    public function setCodeCode(string $codeCode): self
    {
        $this->codeCode = $codeCode;

        return $this;
    }

    public function getCodeQuantite(): ?int
    {
        return $this->codeQuantite;
    }

    public function setCodeQuantite(int $codeQuantite): self
    {
        $this->codeQuantite = $codeQuantite;

        return $this;
    }

    public function getCodeMontant(): ?float
    {
        return $this->codeMontant;
    }

    public function setCodeMontant(float $codeMontant): self
    {
        $this->codeMontant = $codeMontant;

        return $this;
    }

    public function getCodeBloque(): ?int
    {
        return $this->codeBloque;
    }

    public function setCodeBloque(int $codeBloque): self
    {
        $this->codeBloque = $codeBloque;

        return $this;
    }

    public function getCodeType(): ?int
    {
        return $this->codeType;
    }

    public function setCodeType(int $codeType): self
    {
        $this->codeType = $codeType;

        return $this;
    }

    public function getCodeDateCreation(): ?\DateTimeInterface
    {
        return $this->codeDateCreation;
    }

    public function setCodeDateCreation(\DateTimeInterface $codeDateCreation): self
    {
        $this->codeDateCreation = $codeDateCreation;

        return $this;
    }

    public function getCodeDateValide(): ?\DateTimeInterface
    {
        return $this->codeDateValide;
    }

    public function setCodeDateValide(\DateTimeInterface $codeDateValide): self
    {
        $this->codeDateValide = $codeDateValide;

        return $this;
    }
}
