<?php

namespace App\Form;

use App\Entity\CodePromo;
use Stripe\Price;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class CodePromoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codeCode')
            ->add('codeQuantite')
            ->add('codeType', ChoiceType::class, [
                'choices' => [
                    'Euros' => '0',
                    'Pourcentage' => '1', 
            ]]
            ) 
            ->add('codeMontant',MoneyType::class)
            ->add('codeBloque',ChoiceType::class, [
                'choices'  => [
                    'Non' => false,
                    'Oui' => true
                ],
            ]) 
            ->add('codeDateValide', DateType::class, [
                'widget' => 'single_text',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CodePromo::class,
        ]);
    }
}
