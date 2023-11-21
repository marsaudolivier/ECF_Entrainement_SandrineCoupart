<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\NoticesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoticesRepository::class)]
class Notices
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Note = null;

    #[ORM\ManyToOne(inversedBy: 'notices')]
    private ?Recipes $recipes = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[ORM\Column]
    private ?int $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->Note;
    }

    public function setNote(int $Note): static
    {
        $this->Note = $Note;

        return $this;
    }

    public function getRecipes(): ?Recipes
    {
        return $this->recipes;
    }

    public function setRecipes(?Recipes $recipes): static
    {
        $this->recipes = $recipes;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getUser(): ?int
    {
        return $this->user;
    }

    public function setUser(int $user): static
    {
        $this->user = $user;

        return $this;
    }
    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('comment', new NotBlank());
        $metadata->addPropertyConstraint('comment', new Length(['min' => 3, 'max' => 50]));
        $metadata->addPropertyConstraint('comment',  new Assert\Regex(['pattern' => '/^[a-zA-Z0-9]+$/']));
        $metadata->addPropertyConstraint('note', new NotBlank());
        $metadata->addPropertyConstraint('note', new Assert\Range([
            'min' => 1,
            'max' => 5,
            'minMessage' => 'La note doit être d\'au moins 1.',
            'maxMessage' => 'La note ne peut pas dépasser 5.',
        ]));
    }
}
