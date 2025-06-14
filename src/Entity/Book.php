<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $categorie = null;

    #[ORM\Column(length: 255)]
    private ?string $summary = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?int $copies_available = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Author $auteur = null;

    /**
     * @var Collection<int, Emprunt>
     */
    #[ORM\ManyToMany(targetEntity: Emprunt::class, mappedBy: 'book')]
    private Collection $emprunts;

    public function __construct()
    {
        $this->emprunts = new ArrayCollection();
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

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): static
    {
        $this->summary = $summary;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getCopiesAvailable(): ?int
    {
        return $this->copies_available;
    }

    public function setCopiesAvailable(int $copies_available): static
    {
        $this->copies_available = $copies_available;

        return $this;
    }

    public function getAuteurId(): ?Author
    {
        return $this->auteur;
    }

    public function setAuteurId(?Author $auteur_id): static
    {
        $this->auteur = $auteur_id;

        return $this;
    }

    /**
     * @return Collection<int, Emprunt>
     */
    public function getEmprunts(): Collection
    {
        return $this->emprunts;
    }

    public function addEmprunt(Emprunt $emprunt): static
    {
        if (!$this->emprunts->contains($emprunt)) {
            $this->emprunts->add($emprunt);
            $emprunt->addBook($this);
        }

        return $this;
    }

    public function removeEmprunt(Emprunt $emprunt): static
    {
        if ($this->emprunts->removeElement($emprunt)) {
            $emprunt->removeBook($this);
        }

        return $this;
    }
}
