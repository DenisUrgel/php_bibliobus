<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LivreRepository;
use App\Repository\EmpruntRepository;
use App\Entity\Livre;

class EmpruntController extends AbstractController
{
    #[Route('/livres-disponibles', name: 'livres_disponibles')]
    public function livresDisponibles(EmpruntRepository $empruntRepository, LivreRepository $livreRepository): Response
    {
        $livres = $livreRepository->findLivresDisponibles();

        return $this->render('user/livres_disponibles.html.twig', [
            'livres' => $livres,
        ]);
    }

    #[Route('/reserver-livre/{id}', name: 'reserver_livre')]
    public function reserverLivre(Livre $livre): Response
    {
        // Logique de réservation à faire plus tard
        return $this->redirectToRoute('livres_disponibles');
    }
}
