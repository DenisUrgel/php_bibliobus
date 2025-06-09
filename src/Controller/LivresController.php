<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


final class LivresController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function bookList(): Response
    {
        return $this->render('/user/book/index.html.twig');
    }
    
    #[Route('/bookTest', name: 'app_book_test')]
    public function bookListTest(): Response
    {
        return $this->render('Livres.html.twig');
    }

}