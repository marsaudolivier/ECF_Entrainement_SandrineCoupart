<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\Allergens;
use App\Entity\DietTypes;
use App\Entity\Ingredients;
use App\Entity\Notices;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RecipesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

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

    #[ORM\Column(type: Types::TEXT)]
    private ?string $steps = null;

    #[ORM\Column(length: 150)]
    private ?string $image = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $PreparationTime = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $TimeOfRest = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $CookingTime = null;

    #[ORM\Column]
    public ?bool $patients_accessible = null;


    #[ORM\OneToMany(mappedBy: 'user', targetEntity: User::class)]
    private Collection $user_write;

    #[ORM\ManyToMany(targetEntity: DietTypes::class, inversedBy: 'diet')]
    private Collection $diets;

    #[ORM\ManyToMany(targetEntity: Allergens::class, inversedBy: 'allergens')]
    private Collection $allergen;

    #[ORM\ManyToMany(targetEntity: ingredients::class, inversedBy: 'recipes')]
    private Collection $ingredien;

    #[ORM\Column(length: 255)]
    private ?string $TotalTime = null;

    #[ORM\OneToMany(mappedBy: 'recipes', targetEntity: Notices::class)]
    private Collection $notices;


    public function __construct()
    {
        $this->user_write = new ArrayCollection();
        $this->diets = new ArrayCollection();
        $this->allergen = new ArrayCollection();
        $this->ingredien = new ArrayCollection();
        $this->notices = new ArrayCollection();
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
     * @return Collection<int, user>
     */
    public function getUserWrite(): Collection
    {
        return $this->user_write;
    }

    public function addUserWrite(User $userWrite): static
    {
        if (!$this->user_write->contains($userWrite)) {
            $this->user_write->add($userWrite);
            $userWrite->setUser($this);
        }

        return $this;
    }

    public function removeUserWrite(User $userWrite): static
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

    public function addDiet(Diettypes $diet): static
    {
        if (!$this->diets->contains($diet)) {
            $this->diets->add($diet);
        }

        return $this;
    }

    public function removeDiet(Diettypes $diet): static
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

    public function addAllergen(Allergens $allergen): static
    {
        if (!$this->allergen->contains($allergen)) {
            $this->allergen->add($allergen);
        }

        return $this;
    }

    public function removeAllergen(Allergens $allergen): static
    {
        $this->allergen->removeElement($allergen);

        return $this;
    }

    /**
     * Get the value of PreparationTime
     */
    public function getPreparationTime(): ?string
    {
        return $this->PreparationTime;
    }

    /**
     * Set the value of PreparationTime
     */
    public function setPreparationTime(?string $PreparationTime): self
    {
        $this->PreparationTime = $PreparationTime;

        return $this;
    }

    /**
     * Get the value of TimeOfRest
     */
    public function getTimeOfRest(): ?string
    {
        return $this->TimeOfRest;
    }

    /**
     * Set the value of TimeOfRest
     */
    public function setTimeOfRest(?string $TimeOfRest): self
    {
        $this->TimeOfRest = $TimeOfRest;

        return $this;
    }

    /**
     * Get the value of CookingTime
     */
    public function getCookingTime(): ?string
    {
        return $this->CookingTime;
    }

    /**
     * Set the value of CookingTime
     */
    public function setCookingTime(?string $CookingTime): self
    {
        $this->CookingTime = $CookingTime;

        return $this;
    }

    /**
     * @return Collection<int, ingredients>
     */
    public function getIngredien(): Collection
    {
        return $this->ingredien;
    }

    public function addIngredien(ingredients $ingredien): static
    {
        if (!$this->ingredien->contains($ingredien)) {
            $this->ingredien->add($ingredien);
        }

        return $this;
    }

    public function removeIngredien(ingredients $ingredien): static
    {
        $this->ingredien->removeElement($ingredien);

        return $this;
    }

    public function getTotalTime(): ?string
    {
        return $this->TotalTime;
    }

    public function setTotalTime(string $TotalTime): static
    {
        $this->TotalTime = $TotalTime;

        return $this;
    }

    /**
     * @return Collection<int, Notices>
     */

    public function getNotices(): Collection
    {
        return $this->notices;
    }
    //récupération de toutes le notes et mise dans un tableau
    public function getAllNotices()
    {
        $notices = $this->getNotices();
        $notes = [];
        foreach ($notices as $notice) {
            $notes[] = $notice->getNote();
        }
        return $notes;
    }

    public function addNotice(Notices $notice): static
    {
        if (!$this->notices->contains($notice)) {
            $this->notices->add($notice);
            $notice->setRecipes($this);
        }

        return $this;
    }

    public function removeNotice(notices $notice): static
    {
        if ($this->notices->removeElement($notice)) {
            // set the owning side to null (unless already changed)
            if ($notice->getRecipes() === $this) {
                $notice->setRecipes(null);
            }
        }

        return $this;
    }
    
}
