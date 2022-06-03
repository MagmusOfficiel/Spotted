<?php

namespace App\Form;

use App\Entity\Menu;
use App\Entity\Typehm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('menuNom')
            ->add('menuHook', EntityType::class, [
                'class' => Typehm::class,
                'choice_value' => function (?Typehm $entity) {
                    return $entity ? $entity->getId() : '';
                },
                'choice_label' => function (?Typehm $entity) {
                    return $entity ? $entity->getTypehmNom() : '';
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}
