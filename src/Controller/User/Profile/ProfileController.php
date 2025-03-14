<?php

namespace App\Controller\User\Profile;

use App\Entity\User;
use App\Form\UserProfileFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/user')]
final class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_user_profile_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('user/profile/index.html.twig');
    }

    #[Route('/profile/edit', name: 'app_user_profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $em): Response
    {
        /**
         * @var User
         */
        $user = $this->getUser();
        $actualFamilyNumbers = $user->getFamilyMembers();
        // dd($actualFamilyNumbers);

        $form = $this->createForm(UserProfileFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $familyMembersForm = $form->get('familyMembers')->getData();

            if ($familyMembersForm > $actualFamilyNumbers) 
            {
                $user->setWaitingToChangeFamilyMembersNumber($familyMembersForm);

                $em->persist($user);
                $em->flush();

                $this->addFlash('success', "La demande de changement de nombre des membres de la famille est faite");
                return $this->redirectToRoute("app_user_profile_index");
            }
        }

        return $this->render(
            'user/profile/edit.html.twig',
            [
                "form" => $form->createView()
            ]
        );
    }
}

// L'utilisateur:
    // Gerer de son profil
        // Changer le nombre total des membres de la famille
            // Si l'utilisateur choisi de modifier le nombre total des membres de la famille
                // Si la valeur envoyée depuis le formulaire > au nombre total actuel des membres de la famille
                    // Envoyer cette demande à l'admin
                // Sinon si la valeur envoyée depuis le formulaire < au nombre total actuel des membres de la famille
                    // Si le nombre total de livres empruntés > à la nouvelle valeur * 3 
                        // Empêcher la modification
                        // Demander à l'utilisation de rendre d'abord les surplus de livres empruntés avant de pouvoir insérer une valeur inférieur

// L'admin:
    // Voir pour chaque utilisateur, la demande de changement du nombre de membres de la famille
    // Lors du prochain passage, demander à l'utilisateur qui a fait la demande, la pièce d'identité du ou des membres qu'il souhaite ajouter
        // Si les documents sont conformes, 
            // Il valide la demande et le nombre se met à jour dans l'espace privé de l'utilisateur ayant fait la demande.