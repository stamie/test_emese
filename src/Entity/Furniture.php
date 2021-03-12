<?php

namespace App\Entity;

use App\Repository\FurnitureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FurnitureRepository::class)
 */
class Furniture
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
    private $inventory_number;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $modell_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $count;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInventoryNumber(): ?string
    {
        return $this->inventory_number;
    }

    public function setInventoryNumber(string $inventory_number): self
    {
        $this->inventory_number = $inventory_number;

        return $this;
    }

    public function getModellId(): ?int
    {
        return $this->modell_id;
    }

    public function setModellId(?int $modell_id): self
    {
        $this->modell_id = $modell_id;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function getű(): ?string
    {
        return $this->ű;
    }

    public function setű(string $ű): self
    {
        $this->ű = $ű;

        return $this;
    }
}
