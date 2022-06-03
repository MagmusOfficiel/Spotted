<?php

namespace App\Entity;

use App\Repository\CodePromoRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=CodePromoRepository::class)
 * @Vich\Uploadable
 */
class CodePromo
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
    private $codeCode;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    private $codeQuantite;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $codeMontant;

    /**
     * @ORM\Column(type="integer")
     */
    private $codeBloque;

    /**
     * @ORM\Column(type="integer")
     */
    private $codeType;

    /**
     * @ORM\Column(type="date")
     */
    private $codeDateCreation;

    /**
     * @ORM\Column(type="date")
     */
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
