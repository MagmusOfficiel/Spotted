<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PageRepository::class)
 */
class Page
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
    private $pageTitre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pageBaliseTitre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pageMetaDescription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pageMetaCle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pageUrlSimple;

    /**
     * @ORM\Column(type="text")
     */
    private $pageContenu;

    /**
     * @ORM\Column(type="integer")
     */
    private $pageBloque;

    /**
     * @ORM\ManyToOne(targetEntity=PageInfo::class, inversedBy="pageLiaison")
     */
    private $pageInfo;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPageTitre(): ?string
    {
        return $this->pageTitre;
    }

    public function setPageTitre(string $pageTitre): self
    {
        $this->pageTitre = $pageTitre;

        return $this;
    }

    public function getPageBaliseTitre(): ?string
    {
        return $this->pageBaliseTitre;
    }

    public function setPageBaliseTitre(string $pageBaliseTitre): self
    {
        $this->pageBaliseTitre = $pageBaliseTitre;

        return $this;
    }

    public function getPageMetaDescription(): ?string
    {
        return $this->pageMetaDescription;
    }

    public function setPageMetaDescription(?string $pageMetaDescription): self
    {
        $this->pageMetaDescription = $pageMetaDescription;

        return $this;
    }

    public function getPageMetaCle(): ?string
    {
        return $this->pageMetaCle;
    }

    public function setPageMetaCle(?string $pageMetaCle): self
    {
        $this->pageMetaCle = $pageMetaCle;

        return $this;
    }

    public function getPageUrlSimple(): ?string
    {
        return $this->pageUrlSimple;
    }

    public function setPageUrlSimple(string $pageUrlSimple): self
    {
        $this->pageUrlSimple = $pageUrlSimple;

        return $this;
    }

    public function getPageContenu(): ?string
    {
        return $this->pageContenu;
    }

    public function setPageContenu(?string $pageContenu): self
    {
        $this->pageContenu = $pageContenu;

        return $this;
    }

    public function getPageBloque(): ?int
    {
        return $this->pageBloque;
    }

    public function setPageBloque(int $pageBloque): self
    {
        $this->pageBloque = $pageBloque;

        return $this;
    }

    public function getPageInfo(): ?PageInfo
    {
        return $this->pageInfo;
    }

    public function setPageInfo(?PageInfo $pageInfo): self
    {
        $this->pageInfo = $pageInfo;

        return $this;
    }
}
