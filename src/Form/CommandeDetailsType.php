<?php

namespace App\Form;

use App\Entity\CommandeDetails; 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class CommandeDetailsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('produits',TextType::class)
            ->add('quantite',NumberType::class)
            ->add('prix',MoneyType::class)
            ->add('total',MoneyType::class)
            ->add('maCommande',TextType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CommandeDetails::class,
        ]);
    }
}
