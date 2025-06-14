<?php

namespace App\Controller\User\Book;

use App\Entity\Book;
use App\Entity\Author;
use App\Entity\Collections;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/user')]
final class BookController extends AbstractController
{
    #[Route('/book-list', name: 'app_book_list', methods:['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $bookList = $entityManager->getRepository(Book::class)->findAll();

        return $this->render('/user/book/index.html.twig', [
            'controller_name' => 'BookController',
            'bookList' => $bookList
        ]);
    }

    #[Route('/book-details/{id}', name: 'app_book_details', methods: ['GET'])]
    public function bookDetails(EntityManagerInterface $entityManager, int $id): Response{

        $book = $entityManager->getRepository(Book::class)->find($id);
        $auteur = $entityManager->getRepository(Author::class)->find($book->getAuteurId());
        $collection = $entityManager->getRepository(Collections::class)->find($book->getId());

        return $this->render('/user/book/details.html.twig', [
            'controller_name' => 'BookController',
            'book' => $book,
            'bookAuthor' => $auteur,
            'bookCollection' => $collection->getName(),
        ]);
    }
}

class BookController extends AbstractController
{
    #[Route('/bookListNonEmprunter', name: 'app_book_list_non_emprunter', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $qb = $entityManager->createQueryBuilder();

        $qb->select('b')
            ->from(Book::class, 'b')
            ->leftJoin('b.empruntBooks', 'eb')
            ->leftJoin('eb.emprunt', 'e')
            ->where('e.id IS NULL OR e.status = 0')
            ->groupBy('b.id');

        $bookListNonEmprunter = $qb->getQuery()->getResult();

        return $this->render('user/book/index.html.twig', [
            'bookListNonEmprunter' => $bookListNonEmprunter,
        ]);
    }
}