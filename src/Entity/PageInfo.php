<?php

namespace App\Entity;

use App\Repository\PageInfoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PageInfoRepository::class)
 */
class PageInfo
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
     * @ORM\OneToMany(targetEntity=Page::class, mappedBy="pageInfo")
     */
    private $pageLiaison;

    public function __construct()
    {
        $this->pageLiaison = new ArrayCollection();
    }

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

    /**
     * @return Collection|Page[]
     */
    public function getPageLiaison(): Collection
    {
        return $this->pageLiaison;
    }

    public function addPageLiaison(Page $pageLiaison): self
    {
        if (!$this->pageLiaison->contains($pageLiaison)) {
            $this->pageLiaison[] = $pageLiaison;
            $pageLiaison->setPageInfo($this);
        }

        return $this;
    }

    public function removePageLiaison(Page $pageLiaison): self
    {
        if ($this->pageLiaison->removeElement($pageLiaison)) {
            // set the owning side to null (unless already changed)
            if ($pageLiaison->getPageInfo() === $this) {
                $pageLiaison->setPageInfo(null);
            }
        }

        return $this;
    }
}
