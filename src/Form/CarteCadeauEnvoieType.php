<?php

namespace App\Form;

use App\Entity\CarteCadeau;
use App\Entity\CarteCadeauEnvoie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CarteCadeauEnvoieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('carteMontant',ChoiceType::class,[ 
                'label' => 'Selectionnez un montant', 
                'choices' => [
                    '25€' => '25',
                    '50€' => '50',
                    '75€' => '75',
                    '100€' => '100',
                    '125€' => '125',
                    '150€' => '150',
                    'Autre montant' => '?'
                ],
                'expanded' => true,   
                'mapped' => false 
            ])
            ->add('cartePrenom',TextType::class,[
                'label' => 'Prenom*', 
            ])
            ->add('carteNom',TextType::class,[
                'label' => 'Nom de famille*', 
            ])
            ->add('carteEmail',EmailType::class,[
                'label' => 'Courriel du destinataire*', 
            ])
            ->add('carteEmailVerif',EmailType::class,[
                'label' => "Confirmer l'e-mail du destinataire*", 
            ])
            ->add('carteDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Envoyer une carte cadeau',
            ])
            ->add('carteMessage',TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CarteCadeauEnvoie::class,
            'attr' => [
                'novalidate' => 'novalidate'
            ]
        ]);
    }
}
