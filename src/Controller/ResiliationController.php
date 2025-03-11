<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ResiliationController extends AbstractController
{
    #[Route('/resiliation', name: 'app_resiliation')]
    public function index(): Response
    {
        return $this->render('resiliation.html.twig');
    }
}
