<?php

namespace App\Controller\Admin\Book;

use App\Entity\Book;
use App\Entity\Author;
use App\Entity\Emprunt;
use App\Entity\Collections;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin')]
final class BookController extends AbstractController
{
    #[Route('/book-list', name: 'app_admin_book_list', methods:['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $bookList = $entityManager->getRepository(Book::class)->findAll();

        return $this->render('/admin/book/index.html.twig', [
            'controller_name' => 'BookController',
            'bookList' => $bookList
        ]);
    }

    #[Route('/book-details/{id}', name: 'app_admin_book_details', methods: ['GET'])]
    public function bookDetails(EntityManagerInterface $entityManager, int $id): Response{

        $book = $entityManager->getRepository(Book::class)->find($id);
        $auteur = $entityManager->getRepository(Author::class)->find($book->getAuteurId());
        $collection = $entityManager->getRepository(Collections::class)->find($book->getId());

        return $this->render('/book/details.html.twig', [
            'controller_name' => 'BookController',
            'book' => $book,
            'bookAuthor' => $auteur,
            'bookCollection' => $collection->getName(),
        ]);
    }

    #[Route('/emprunt', name: 'app_admin_emprunt', methods: ['GET'])]
    public function emprunt(EntityManagerInterface $entityManager): Response
    {
        $emprunts = $entityManager->getRepository(Emprunt::class)->findAll();

        return $this->render('/admin/book/emprunt.html.twig', [
            'controller_name' => 'BookController',
            'emprunts' => $emprunts
        ]);
    }

    #[Route('/rendu/{id}', name: 'app_admin_rendu', methods: ['GET'])]
    public function rendu(EntityManagerInterface $entityManager, int $id): Response
    {
        $emprunts = $entityManager->getRepository(Emprunt::class)->findAll();
        $emprunt = $entityManager->getRepository(Emprunt::class)->find($id);
        $emprunt->setStatus('0');
        $entityManager->persist($emprunt);
        $entityManager->flush();

        return $this->render('/admin/book/emprunt.html.twig', [
            'controller_name' => 'BookController',
            'emprunts' => $emprunts
        ]);
    }
}
