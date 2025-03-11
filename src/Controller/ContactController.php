<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function register(): Response
    {
        return $this->render('contact.html.twig');
    }

}