<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\Typehm;
use App\Entity\Couleur;
use App\Entity\Produit;
use App\Entity\Categories; 
use App\Form\ProduitImageType; 
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface; 
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\OptionsResolver\OptionsResolver;   
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('produitRef')
            ->add('produitLibelle')
            ->add('couleur', EntityType::class,[
                'class' => Couleur::class,   
                'choice_value' => function (?Couleur $entity) {
                    return $entity ? $entity->getId() : '';
                },
                'choice_label' => function (?Couleur $entity) {
                    return $entity ? $entity->getCouleurNom() : '';
                }
            ])

            ->add('produitDescription')
            ->add('produitPrix')
            ->add('produitStock')
            ->add('produitNouveaute', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('produit_images', CollectionType::class, [
                'entry_type' => ProduitImageType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true
            ])
            ->add('produitBloque',ChoiceType::class, [
                'choices'  => [
                    'Non' => false,
                    'Oui' => true
                ],
            ])
            ->add('categories', EntityType::class, [
                'class' => Categories::class,
                'choice_value' => function (?Categories $entity) {
                    return $entity ? $entity->getId() : '';
                },
                'choice_label' => function (?Categories $entity) {
                    return $entity ? $entity->getCatNom() : '';
                }
            ])
            ->add('typehm', EntityType::class, [
                'class' => Typehm::class,
                'choice_value' => function (?Typehm $entity) {
                    return $entity ? $entity->getId() : '';
                },
                'choice_label' => function (?Typehm $entity) {
                    return $entity ? $entity->getTypehmNom() : '';
                }
            ])
            ->add('marques', EntityType::class, [
                'class' => Marque::class,
                'choice_value' => function (?Marque $entity) {
                    return $entity ? $entity->getId() : '';
                },
                'choice_label' => function (?Marque $entity) {
                    return $entity ? $entity->getMarqueNom() : '';
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
