<?php

namespace App\Controller\Admin\Home;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/admin/home', name: 'app_admin_index')]
    public function index(): Response
    {
        return $this->render('admin/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
