<?php

namespace App\Form;

use App\Entity\Pays;
use App\Entity\Utilisateur; 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username',TextType::class,[
                'attr' => [
                    'placeholder' => 'Nom',   
                ]
            ])
            ->add('userPrenom',TextType::class,[
                'attr' => [
                    'placeholder' => 'Prenom',
                ]
            ])
            ->add('password', PasswordType::class,[
                'attr' => [
                    'placeholder' => 'Mot de passe',
                ]
            ])
            ->add('verifPassword', PasswordType::class,[
                'attr' => [
                    'placeholder' => 'Vérification mot de passe',
                ]
            ])
            ->add('userMail', EmailType::class,[
                
                'attr' => [
                    'placeholder' => 'Adresse e-mail',
                ]
            ])
            ->add('userNaissance', DateType::class, [
                'widget' => 'single_text',
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
                'expanded' => true,
                'choices' => [
                    'Homme' => 'homme',
                    'Femme' => 'femme',
                    'Unisexe' => 'unisexe'
                ]
            ]);
    }

    public function getBlockPrefix(): ?string
    {
        return 'inscription_type';
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
