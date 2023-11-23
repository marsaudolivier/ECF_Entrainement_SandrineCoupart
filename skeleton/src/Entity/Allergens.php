<?php

namespace App\Entity;

use App\Entity\Recipes;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AllergensRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;


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
    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('name', new NotBlank());
        $metadata->addPropertyConstraint('name', new Assert\Regex([
            'pattern' => '/^[a-zA-Z0-9\sÀ-ÖØ-öø-ÿ.\'-]+$/u',
            'message' => 'usage des chiffre et lettre uniquement'
        ]));    }
}
