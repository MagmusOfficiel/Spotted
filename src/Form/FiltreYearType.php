<?php

namespace App\Form;

use App\Classe\FiltreYear;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltreYearType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateAnnee', ChoiceType::class, [
                'choices'  => [
                    '2020' => 2020,
                    '2021' => 2021,
                    '2022' => 2022,
                ],
                'label' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FiltreYear::class,
            'method' => 'GET',
            'crsf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
