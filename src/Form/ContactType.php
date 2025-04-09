<?php

namespace App\Form;

use PhpParser\Node\Stmt\Label;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, ["label" => 'Prénom'])
            ->add('nom', TextType::class)
            ->add('email', EmailType::class)
            ->add('subject', TextType::class, ['label' => 'Objet'])
            ->add('message', TextareaType::class)
            ->add('send', SubmitType::class, ['label' => 'Envoyer']);
            // création d'un formulaire de contact
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
