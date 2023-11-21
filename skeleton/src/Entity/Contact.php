<?php

namespace App\Entity;


use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ContactRepository;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $firstname = null;

    #[ORM\Column(length: 50)]
    private ?string $lastname = null;

    #[ORM\Column(length: 10)]
    private ?string $phone = null;

    #[ORM\Column(length: 50)]
    private ?string $mail = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $request = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getRequest(): ?string
    {
        return $this->request;
    }

    public function setRequest(string $request): static
    {
        $this->request = $request;

        return $this;
    }
    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('firstname', new NotBlank());
        $metadata->addPropertyConstraint('firstname', new Length(['min' => 3, 'max' => 50]));
        $metadata->addPropertyConstraint('firstname',  new Assert\Regex(['pattern' => '/^[a-zA-Z0-9]+$/']));
        $metadata->addPropertyConstraint('lastname', new NotBlank());
        $metadata->addPropertyConstraint('lastname', new Length(['min' => 3, 'max' => 50]));
        $metadata->addPropertyConstraint('lastname',  new Assert\Regex(['pattern' => '/^[a-zA-Z0-9]+$/']));
        $metadata->addPropertyConstraint('phone', new NotBlank());
        $metadata->addPropertyConstraint('phone',  new Assert\Regex(['pattern' => '/^0[1-9](\d{2}){4}$/',
        'message' => 'Le numéro de téléphone doit être au format français, par exemple 0549334788.']));
        $metadata->addPropertyConstraint('mail', new NotBlank());
        $metadata->addPropertyConstraint('mail', new Assert\Email([
            'message' => 'Veuillez entrer une adresse e-mail valide.']));
        $metadata->addPropertyConstraint('mail', new Assert\Length(['min' => 3, 'max' => 50]));
        $metadata->addPropertyConstraint('request', new NotBlank());
        $metadata->addPropertyConstraint('request', new Length(['min' => 3, 'max' => 500]));
        $metadata->addPropertyConstraint('request',  new Assert\Regex(['pattern' => '/^[a-zA-Z0-9]+$/']));
    }
}
