<?php

namespace App\Form;

use App\Entity\SousCategories; 
use App\Entity\SousSousCategories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SousSousCategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sousSousCatNom')
            ->add('sousCat', EntityType::class, [
                'class' => SousCategories::class,
                'choice_value' => function (?SousCategories $entity) {
                    return $entity ? $entity->getId() : '';
                },
                'choice_label' => function (?SousCategories $entity) {
                    return $entity ? $entity->getSousCatNom() : '';
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SousSousCategories::class,
        ]);
    }
}
