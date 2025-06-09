<?php

namespace App\Entity;

use App\Repository\BookCollectionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookCollectionRepository::class)]
class BookCollection
{
    #[ORM\Id]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?book $book = null;

    #[ORM\Id]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?collections $collection = null;

    public function getBookId(): ?book
    {
        return $this->book;
    }

    public function setBookId(?book $book_id): static
    {
        $this->book = $book_id;

        return $this;
    }

    public function getCollectionId(): ?collections
    {
        return $this->collection;
    }

    public function setCollectionId(?collections $collection_id): static
    {
        $this->collection = $collection_id;

        return $this;
    }
}
