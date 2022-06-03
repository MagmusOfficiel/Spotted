<?php

namespace App\Form;

use App\Entity\Page;
use App\Entity\PageInfo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pageTitre')
            ->add('pageBaliseTitre')
            ->add('pageMetaDescription')
            ->add('pageMetaCle')
            ->add('pageUrlSimple')
            ->add('pageContenu',TextareaType::class)
            ->add('pageBloque',ChoiceType::class, [
                'choices'  => [
                    'Non' => false,
                    'Oui' => true
                ],
            ])
            ->add('pageInfo', EntityType::class, [
                'class' => PageInfo::class,
                'choice_value' => function (?PageInfo $entity) {
                    return $entity ? $entity->getId() : '';
                },
                'choice_label' => function (?PageInfo $entity) {
                    return $entity ? $entity->getPageTitre() : '';
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Page::class,
        ]);
    }
}
