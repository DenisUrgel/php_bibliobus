<?php

namespace App\Entity;

use App\Repository\EmpruntRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmpruntRepository::class)]
class Emprunt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $must_be_returned_at = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $borrowed_at = null;

    #[ORM\ManyToOne(inversedBy: 'emprunts')]
    private ?User $user = null;

    /**
     * @var Collection<int, Book>
     */
    #[ORM\ManyToMany(targetEntity: Book::class, inversedBy: 'emprunts')]
    private Collection $book;

    public function __construct()
    {
        $this->book = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMustBeReturnedAt(): ?\DateTimeImmutable
    {
        return $this->must_be_returned_at;
    }

    public function setMustBeReturnedAt(\DateTimeImmutable $must_be_returned_at): static
    {
        $this->must_be_returned_at = $must_be_returned_at;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getBorrowedAt(): ?\DateTimeImmutable
    {
        return $this->borrowed_at;
    }

    public function setBorrowedAt(\DateTimeImmutable $borrowed_at): static
    {
        $this->borrowed_at = $borrowed_at;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Book>
     */
    public function getBook(): Collection
    {
        return $this->book;
    }

    public function addBook(Book $book): static
    {
        if (!$this->book->contains($book)) {
            $this->book->add($book);
        }

        return $this;
    }

    public function removeBook(Book $book): static
    {
        $this->book->removeElement($book);

        return $this;
    }
}
