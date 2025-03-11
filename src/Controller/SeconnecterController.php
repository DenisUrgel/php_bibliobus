<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


final class SeconnecterController extends AbstractController
{
    #[Route('/seconnecter', name: 'app_seconnecter')]
    public function register(): Response
    {
        return $this->render('seconnecter.html.twig');
    }

}