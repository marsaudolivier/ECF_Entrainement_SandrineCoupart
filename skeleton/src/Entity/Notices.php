<?php

namespace App\Entity;

use App\Repository\NoticesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoticesRepository::class)]
class Notices
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $note = null;

    #[ORM\OneToMany(mappedBy: 'notes', targetEntity: Recipes::class)]
    private Collection $notes;

    #[ORM\ManyToMany(targetEntity: Recipes::class, mappedBy: 'note')]
    private Collection $recipes;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
        $this->recipes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): static
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return Collection<int, Recipes>
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Recipes $note): static
    {
        if (!$this->notes->contains($note)) {
            $this->notes->add($note);
            $note->setNotes($this);
        }

        return $this;
    }

    public function removeNote(Recipes $note): static
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getNotes() === $this) {
                $note->setNotes(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Recipes>
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function addRecipe(Recipes $recipe): static
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes->add($recipe);
            $recipe->addNote($this);
        }

        return $this;
    }

    public function removeRecipe(Recipes $recipe): static
    {
        if ($this->recipes->removeElement($recipe)) {
            $recipe->removeNote($this);
        }

        return $this;
    }
}
