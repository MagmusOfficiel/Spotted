<?php

namespace App\Form;

use App\Entity\Eshop;
use App\Entity\Typehm;
use App\Entity\Categories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('catNom')
            ->add('catEshop', EntityType::class, [
                'class' => Eshop::class,
                'choice_value' => function (?Eshop $entity) {
                    return $entity ? $entity->getId() : '';
                },
                'choice_label' => function (?Eshop $entity) {
                    return $entity ? $entity->getEshopNom() : '';
                }
            ])
            ->add('catTypehm', EntityType::class, [
                'class' => Typehm::class,
                'choice_value' => function (?Typehm $entity) {
                    return $entity ? $entity->getId() : '';
                },
                'choice_label' => function (?Typehm $entity) {
                    return $entity ? $entity->getTypehmNom() : '';
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categories::class,
        ]);
    }
}
