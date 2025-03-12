<?php

namespace App\Controller\User\Home;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user')]

final class HomeController extends AbstractController
{
    #[Route('/user/home', name: 'app_user_index', methods:['GET'])]
    public function index(): Response
    {
        return $this->render('user/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
