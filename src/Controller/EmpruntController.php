<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;
use App\Repository\EmpruntRepository;
use App\Entity\Book;

class EmpruntController extends AbstractController
{
    #[Route('/livres-disponibles', name: 'livres_disponibles')]
    public function livresDisponibles(EmpruntRepository $empruntRepository, BookRepository $livreRepository): Response
    {
        $livres = $livreRepository->findAll();

        return $this->render('user/book/livres_disponibles.html.twig', [
            'livres' => $livres,
        ]);
    }

    #[Route('/reserver-livre/{id}', name: 'reserver_livre')]
    public function reserverLivre(Book $book): Response
    {
        // Logique de réservation à faire plus tard
        return $this->redirectToRoute('livres_disponibles');
    }
}
