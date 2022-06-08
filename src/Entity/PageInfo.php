<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PageInfoRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Table(name: 'PageInfo')]
#[ORM\Entity(repositoryClass: PageInfoRepository::class)]
class PageInfo
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $pageTitre;

    #[ORM\OneToMany(targetEntity:Page::class, mappedBy:"pageInfo")]
    private Page $pageLiaison;

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
