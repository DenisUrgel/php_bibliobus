<?php

namespace App\Controller\Admin\User;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin')]
final class UserController extends AbstractController
{
    public function __construct(
        private UserRepository $userRepository,
        private EntityManagerInterface $em
    ) {
    }

    #[Route('/user/list', name: 'app_admin_user_index', methods:['GET'])]
    public function index(): Response
    {
        return $this->render('admin/user/index.html.twig', [
            "users" => $this->userRepository->findAll()
        ]);
    }

    #[Route('/user/process-to-change-family-members-number/{id}/{number}', name: 'app_admin_user_process_to_change_family_members_number', methods:['GET'])]
    public function processToChangeFamilyMembersNumber(int $id, int $number): Response
    {
        $user = $this->userRepository->find($id);

        if ( null === $user ) 
        {
            return $this->redirectToRoute('app_admin_user_index');
        }

        $user->setFamilyMembers($number);
        $user->setWaitingToChangeFamilyMembersNumber(null);

        $this->em->persist($user);
        $this->em->flush();

        $this->addFlash('success', "Le traitement concernant {$user->getFirstName()} {$user->getLastName()} a été un succès");
        return $this->redirectToRoute('app_admin_user_index');
    }
}
