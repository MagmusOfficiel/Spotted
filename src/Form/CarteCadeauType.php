<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\Categories;
use App\Entity\CarteCadeau;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CarteCadeauType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('cartecadeauRef')
        ->add('cartecadeauLibelle')
        ->add('cartecadeauDescription')
        ->add('cartecadeauNouveaute', DateType::class, [
            'widget' => 'single_text',
        ])
        ->add('cartecadeauBloque',ChoiceType::class, [
            'choices'  => [
                'Non' => false,
                'Oui' => true
            ],
        ])
        ->add('imageFile', FileType::class, [
            'required' => true
        ])
        ->add('categories', EntityType::class, [
            'class' => Categories::class,
            'choice_value' => function (?Categories $entity) {
                return $entity ? $entity->getId() : '';
            },
            'choice_label' => function (?Categories $entity) {
                return $entity ? $entity->getCatNom() : '';
            }
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CarteCadeau::class,
        ]);
    }
}
