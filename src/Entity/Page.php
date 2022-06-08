<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PageRepository;

#[ORM\Table(name: 'Page')]
#[ORM\Entity(repositoryClass: PageRepository::class)]
class Page
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $pageTitre;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $pageBaliseTitre;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private string $pageMetaDescription;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private string $pageMetaCle;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $pageUrlSimple;

    #[ORM\Column(type: Types::TEXT)]
    private string $pageContenu;

    #[ORM\Column(type: Types::INTEGER)]
    private int $pageBloque;

    #[ORM\ManyToOne(targetEntity: PageInfo::class, inversedBy: "pageLiaison")]
    private PageInfo $pageInfo;


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
