<?php
namespace App\Form;
 
use App\Entity\ProduitImage; 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
                ->add('imageFile',VichImageType::class, [
                    'required' => false,
                    'download_uri' => true,
                    'image_uri' => true
                ]);
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProduitImage::class,
        ]);
    }
}