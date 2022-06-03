<?php

namespace App\Form;

use App\Entity\Reseaux;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReseauxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reseauNom') 
            ->add('reseauLien')
            ->add('imageFile',VichImageType::class, [
                'required' => false,
                'download_uri' => true,
                'image_uri' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reseaux::class,
        ]);
    }
}
