<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\SousCategories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SousCategoriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sousCatNom')
            ->add('sousCatCat', EntityType::class, [
                'class' => Categories::class,
                'choice_value' => function (?Categories $entity) {
                    return $entity ? $entity->getId() : '';
                },
                'choice_label' => function (?Categories $entity) {
                    return $entity ? $entity->getcatNom() : '';
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SousCategories::class,
        ]);
    }
}
