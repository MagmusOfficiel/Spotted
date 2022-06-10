<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuRepository;

#[ORM\Table(name: 'Menu')]
#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $menuNom;

    #[ORM\Column(type: Types::INTEGER)]
    private int $menuPosition;

    #[ORM\OneToOne(targetEntity: Typehm::class, cascade: ["persist", "remove"])]
    private ?Typehm $menuHook;

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
