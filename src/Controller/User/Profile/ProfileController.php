<?php

namespace App\Controller\User\Profile;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

    #[Route('/user')]
final class ProfileController extends AbstractController
{
    #[Route('profile', name: 'app_user_profile_index',methods:['GET'])]
    public function index(): Response
    {
        return $this->render('user/profile/index.html.twig');
    }
}
