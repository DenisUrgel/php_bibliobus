<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message: "L'email est obligatoire.")]
    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[Assert\NotBlank(message: "Le mot de passe est obligatoire.")]
    #[Assert\Length(
        min: 12,
        max: 255,
        minMessage: "Le mot de passe doit contenir au minimum {{ limit }} caractères.",
        maxMessage: "Le mot de passe doit contenir au maximum {{ limit }} caractères.",
    )]
    #[Assert\Regex(
        pattern: "/^(?=.*[a-zà-ÿ])(?=.*[A-ZÀ-Ỳ])(?=.*[0-9])(?=.*[^a-zà-ÿA-ZÀ-Ỳ0-9]).{11,255}$/",
        match: true,
        message: "Le mot de passe doit contentir au moins une lettre miniscule, majuscule, un chiffre et un caractère spécial.",
    )]
    #[ORM\Column]
    private ?string $password = null;

    #[Assert\NotBlank(message: "Le prénom est obligatoire.")]
    #[Assert\Length(
        max: 50,
        maxMessage: "Le prénom ne doit pas dépasser {{ limit }} caractères.",
    )]
    #[ORM\Column(length: 50)]
    private ?string $firstName = null;

    #[Assert\NotBlank(message: "Le nom est obligatoire.")]
    #[Assert\Length(
        max: 50,
        maxMessage: "Le nom ne doit pas dépasser {{ limit }} caractères.",
    )]
    #[ORM\Column(length: 50)]
    private ?string $lastName = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;


    #[ORM\Column(nullable: true)]
    private ?int $waitingToChangeFamilyMembersNumber = null;

    

    #[Assert\NotBlank(message: "Le nombre total des membres de votre famille est obligatoire.")]
    #[Assert\Positive(message: "Le nombre total des membres de la famille doit être positif.")]
    #[Assert\Range(
        min: 1,
        max: 50,
        notInRangeMessage: "Le nombre total des membres de la famille doit être compris entre {{ min }} et {{ max }}.",
    )]
    #[ORM\Column]
    private ?int $familyMembers = null;


    #[ORM\Column]
    private bool $isVerified = false;

    #[Assert\NotBlank(message: "L'adresse est obligatoire.")]
    #[Assert\Length(
        max: 255,
        maxMessage: "L'adresse ne doit pas dépasser {{ limit }} caractères.",
    )]
    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[Assert\NotBlank(message: "La nom de la ville est obligatoire.")]
    #[Assert\Length(
        max: 50,
        maxMessage: "La nom de la ville ne doit pas dépasser {{ limit }} caractères.",
    )]
    #[ORM\Column(length: 50)]
    private ?string $city = null;

    #[Assert\NotBlank(message: "Le code postal est obligatoire.")]
    #[Assert\Length(
        max: 5,
        maxMessage: "Le code postal ne doit pas dépasser {{ limit }} caractères.",
    )]
    #[ORM\Column(length: 5)]
    private ?string $zipCode = null;

    #[ORM\Column]
    private ?bool $isDepositPaid = null;

    #[ORM\Column]
    private ?bool $isSubscribed = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getFamilyMembers(): ?int
    {
        return $this->familyMembers;
    }

    public function setFamilyMembers(?int $familyMembers): static
    {
        $this->familyMembers = $familyMembers;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): static
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function isDepositPaid(): ?bool
    {
        return $this->isDepositPaid;
    }

    public function setIsDepositPaid(bool $isDepositPaid): static
    {
        $this->isDepositPaid = $isDepositPaid;

        return $this;
    }

    public function isSubscribed(): ?bool
    {
        return $this->isSubscribed;
    }

    public function setIsSubscribed(bool $isSubscribed): static
    {
        $this->isSubscribed = $isSubscribed;

        return $this;
    }

    public function getWaitingToChangeFamilyMembersNumber(): ?int
    {
        return $this->waitingToChangeFamilyMembersNumber;
    }

    public function setWaitingToChangeFamilyMembersNumber(?int $waitingToChangeFamilyMembersNumber): static
    {
        $this->waitingToChangeFamilyMembersNumber = $waitingToChangeFamilyMembersNumber;

        return $this;
    }
}
