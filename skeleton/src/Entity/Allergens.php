<?php

namespace App\Entity;

use App\Repository\AllergensRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AllergensRepository::class)]
class Allergens
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $type = null;

    #[ORM\ManyToMany(targetEntity: Recipes::class, mappedBy: 'allergen')]
    private Collection $allergens;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'allergen')]
    private Collection $allergen;

    public function __construct()
    {
        $this->allergens = new ArrayCollection();
        $this->allergen = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Recipes>
     */
    public function __toString(): string
    {
        return $this->type;
    }

    public function addAllergen(Recipes $allergen): static
    {
        if (!$this->allergens->contains($allergen)) {
            $this->allergens->add($allergen);
            $allergen->addAllergen($this);
        }

        return $this;
    }

    public function removeAllergen(Recipes $allergen): static
    {
        if ($this->allergens->removeElement($allergen)) {
            $allergen->removeAllergen($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getAllergen(): Collection
    {
        return $this->allergen;
    }
}
