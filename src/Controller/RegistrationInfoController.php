<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RegistrationInfoController extends AbstractController
{

    #[Route('/register-info', name: 'app_register_info')]
    public function details(): Response
    {
        return $this->render('register_info.html.twig');
    }
}
