<?php

namespace App\Entity;

use App\Repository\DietTypesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DietTypesRepository::class)]
class DietTypes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $type = null;

    #[ORM\ManyToMany(targetEntity: Recipes::class, mappedBy: 'diets')]
    private Collection $diet;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'diets')]
    private Collection $diets;

    public function __construct()
    {
        $this->diet = new ArrayCollection();
        $this->diets = new ArrayCollection();
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

    public function addDiet(Recipes $diet): static
    {
        if (!$this->diet->contains($diet)) {
            $this->diet->add($diet);
            $diet->addDiet($this);
        }

        return $this;
    }

    public function removeDiet(Recipes $diet): static
    {
        if ($this->diet->removeElement($diet)) {
            $diet->removeDiet($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getDiets(): Collection
    {
        return $this->diets;
    }
}
