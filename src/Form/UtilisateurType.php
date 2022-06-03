<?php

namespace App\Form;

use App\Entity\Pays;
use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('userPrenom')
            ->add('roles', ChoiceType::class, [
                'multiple' => false,
                'choices' => [
                    'SUPER ADMIN' => 'ROLE_SUPER_ADMIN',
                    'ADMIN' => 'ROLE_ADMIN',
                    'USER' => 'ROLE_USER',
                ],
                'mapped' => false,
                'expanded' => true
            ])
            ->add('password', PasswordType::class)
            ->add('userMail', EmailType::class)
            ->add('userNaissance', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('userNationalite', EntityType::class, [
                'class' => Pays::class,
                'placeholder' => 'Pays', 
                'choice_value' => function (?Pays $entity) { 
                    return $entity ? $entity->getId() : '';
                },
                'choice_label' => function (?Pays $entity) {
                    return $entity ? $entity->getPaysNom() : '';
                }, 
                'required' => false, 
            ])

            ->add('userSexe', ChoiceType::class, [
                'choices' => [
                    'Homme' => 'homme',
                    'Femme' => 'femme',
                    'Unisexe' => 'unisexe'
                ]

            ]);
    }



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
