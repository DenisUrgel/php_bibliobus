<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Ici tu peux envoyer un email ou traiter les données

            // $emailAddress = $contact->getEmail();
            // if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            //     throw new \Exception('Adresse email invalide');
            // }

            $email = (new Email())
                ->from($contact->getEmail())
                ->replyTo($contact->getEmail())
                ->to('bibliobus@gmail.com')
                ->subject('Nouveau message de contact bibliobus : '. $contact->getSubject())
                ->text(
                    "Nom : " . $contact->getNom() . "\n\n" .
                        "Prénom : " . $contact->getFirstName() . "\n\n" .
                        "Email : " . $contact->getEmail() . "\n\n" .
                        "Message : \n" . $contact->getMessage() . "\n\n"
                );

            $mailer->send($email);

            $this->addFlash('success', 'Votre message a bien été envoyé !');
            return $this->redirectToRoute('app_contact');
        }

        return $this->render('/user/contact/index.html.twig', [
            'form' => $form->createView(),
        ]);

        // return $this->render('contact.html.twig');
    }
}
