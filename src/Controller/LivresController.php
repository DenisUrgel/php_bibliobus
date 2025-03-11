<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


final class LivresController extends AbstractController
{
    #[Route('/livres', name: 'app_livres')]
    public function register(): Response
    {
        return $this->render('livres.html.twig');
    }

}