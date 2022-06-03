<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MenuRepository::class)
 */
class Menu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @var string
     */
    private $menuNom;

    /**
     * @ORM\Column(type="integer")
     */
    private $menuPosition;

    /**
     * @ORM\OneToOne(targetEntity=Typehm::class, cascade={"persist", "remove"})
     */
    private $menuHook;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMenuNom(): ?string
    {
        return $this->menuNom;
    }

    public function setMenuNom(string $menuNom): self
    {
        $this->menuNom = $menuNom;

        return $this;
    }

    public function getMenuPosition(): ?int
    {
        return $this->menuPosition;
    }

    public function setMenuPosition(int $menuPosition): self
    {
        $this->menuPosition = $menuPosition;

        return $this;
    }

    public function getMenuHook(): ?Typehm
    {
        return $this->menuHook;
    }

    public function setMenuHook(?Typehm $menuHook): self
    {
        $this->menuHook = $menuHook;

        return $this;
    }
}
