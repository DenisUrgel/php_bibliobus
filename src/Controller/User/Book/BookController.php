<?php

namespace App\Controller\User\Book;

use App\Entity\Book;
use App\Entity\User;
use App\Entity\Author;
use DateTimeImmutable;
use App\Entity\Emprunt;
use App\Entity\Collections;
use Doctrine\ORM\EntityManagerInterface;
use function Symfony\Component\Clock\now;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/user')]
final class BookController extends AbstractController
{
    #[Route('/book-list', name: 'app_book_list', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $bookList = $entityManager->getRepository(Book::class)->findAll();

        $bookAvailable = [];

        foreach ($bookList as $book) {
            $emprunts = $book->getEmprunts()->toArray();
            if (empty($emprunts)) {
                $bookAvailable[] = $book;
            } else {
                usort($emprunts, function ($a, $b) {
                    return $b->getBorrowedAt() <=> $a->getBorrowedAt();
                });
                $dernierEmprunt = $emprunts[0];
                if ($dernierEmprunt->getStatus() === '0' || $dernierEmprunt->getStatus() === 0) {
                    $bookAvailable[] = $book;
                }
            }
        }

        return $this->render('/user/book/index.html.twig', [
            'controller_name' => 'BookController',
            'bookList' => $bookAvailable
        ]);
    }

    #[Route('/book-details/{id}', name: 'app_book_details', methods: ['GET'])]
    public function bookDetails(EntityManagerInterface $entityManager, int $id): Response
    {

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

    #[Route('/book-reserve/{id}/{user_id}', name: 'app_book_reserve', methods: ['GET'])]
    public function bookResever(EntityManagerInterface $entityManager, int $id, int $user_id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($user_id);

        $book = $entityManager->getRepository(Book::class)->find($id);
        $auteur = $entityManager->getRepository(Author::class)->find($book->getAuteurId());
        $collection = $entityManager->getRepository(Collections::class)->find($book->getId());

        $today = new DateTimeImmutable();

        $emprunt = new Emprunt();
        $emprunt->setUser($user);
        $emprunt->setBorrowedAt($today);
        $emprunt->setMustBeReturnedAt($today->modify('+3 months'));
        $emprunt->setStatus('1');
        $emprunt->addBook($book);
        
        $entityManager->persist($emprunt);
        $entityManager->flush();

        return $this->render('/user/book/details.html.twig', [
            'controller_name' => 'BookController',
            'book' => $book,
            'bookAuthor' => $auteur,
            'bookCollection' => $collection->getName(),
            'message' => 'Livre ' . $book->getTitle() . ' bien réservé par ' . $user->getFirstName(),
        ]);
    }
}
