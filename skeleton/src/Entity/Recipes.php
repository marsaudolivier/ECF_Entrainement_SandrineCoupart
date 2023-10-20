<?php

namespace App\Entity;

use App\Repository\RecipesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipesRepository::class)]
class Recipes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $preparation_time = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $time_of_rest = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $cooking_time = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $steps = null;

    #[ORM\Column(length: 150)]
    private ?string $image = null;

    #[ORM\Column]
    private ?bool $patients_accessible = null;

    #[ORM\ManyToMany(targetEntity: Recipes::class, mappedBy: 'ingredient')]
    private Collection $ingredient;

    #[ORM\ManyToMany(targetEntity: notices::class, inversedBy: 'recipes')]
    private Collection $note;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: user::class)]
    private Collection $user_write;

    #[ORM\ManyToMany(targetEntity: diettypes::class, inversedBy: 'diet')]
    private Collection $diets;

    #[ORM\ManyToMany(targetEntity: allergens::class, inversedBy: 'allergens')]
    private Collection $allergen;

    public function __construct()
    {
        $this->ingredient = new ArrayCollection();
        $this->note = new ArrayCollection();
        $this->user_write = new ArrayCollection();
        $this->diets = new ArrayCollection();
        $this->allergen = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPreparationTime(): ?\DateTimeInterface
    {
        return $this->preparation_time;
    }

    public function setPreparationTime(\DateTimeInterface $preparation_time): static
    {
        $this->preparation_time = $preparation_time;

        return $this;
    }

    public function getTimeOfRest(): ?\DateTimeInterface
    {
        return $this->time_of_rest;
    }

    public function setTimeOfRest(?\DateTimeInterface $time_of_rest): static
    {
        $this->time_of_rest = $time_of_rest;

        return $this;
    }

    public function getCookingTime(): ?\DateTimeInterface
    {
        return $this->cooking_time;
    }

    public function setCookingTime(?\DateTimeInterface $cooking_time): static
    {
        $this->cooking_time = $cooking_time;

        return $this;
    }

    public function getSteps(): ?string
    {
        return $this->steps;
    }

    public function setSteps(string $steps): static
    {
        $this->steps = $steps;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function isPatientsAccessible(): ?bool
    {
        return $this->patients_accessible;
    }

    public function setPatientsAccessible(bool $patients_accessible): static
    {
        $this->patients_accessible = $patients_accessible;

        return $this;
    }

    /**
     * @return Collection<int, Recipes>
     */
    public function getIngredient(): Collection
    {
        return $this->ingredient;
    }

    public function addIngredient(Recipes $ingredient): static
    {
        if (!$this->ingredient->contains($ingredient)) {
            $this->ingredient->add($ingredient);
            $ingredient->addIngredient($this);
        }

        return $this;
    }

    public function removeIngredient(Recipes $ingredient): static
    {
        if ($this->ingredient->removeElement($ingredient)) {
            $ingredient->removeIngredient($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, notices>
     */
    public function getNote(): Collection
    {
        return $this->note;
    }

    public function addNote(notices $note): static
    {
        if (!$this->note->contains($note)) {
            $this->note->add($note);
        }

        return $this;
    }

    public function removeNote(notices $note): static
    {
        $this->note->removeElement($note);

        return $this;
    }

    /**
     * @return Collection<int, user>
     */
    public function getUserWrite(): Collection
    {
        return $this->user_write;
    }

    public function addUserWrite(user $userWrite): static
    {
        if (!$this->user_write->contains($userWrite)) {
            $this->user_write->add($userWrite);
            $userWrite->setUser($this);
        }

        return $this;
    }

    public function removeUserWrite(user $userWrite): static
    {
        if ($this->user_write->removeElement($userWrite)) {
            // set the owning side to null (unless already changed)
            if ($userWrite->getUser() === $this) {
                $userWrite->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, diettypes>
     */
    public function getDiets(): Collection
    {
        return $this->diets;
    }

    public function addDiet(diettypes $diet): static
    {
        if (!$this->diets->contains($diet)) {
            $this->diets->add($diet);
        }

        return $this;
    }

    public function removeDiet(diettypes $diet): static
    {
        $this->diets->removeElement($diet);

        return $this;
    }

    /**
     * @return Collection<int, allergens>
     */
    public function getAllergen(): Collection
    {
        return $this->allergen;
    }

    public function addAllergen(allergens $allergen): static
    {
        if (!$this->allergen->contains($allergen)) {
            $this->allergen->add($allergen);
        }

        return $this;
    }

    public function removeAllergen(allergens $allergen): static
    {
        $this->allergen->removeElement($allergen);

        return $this;
    }
}
