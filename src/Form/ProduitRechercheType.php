<?php

namespace App\Form;

use App\Entity\Produit;
use App\Entity\Categories;
use App\Classe\ProduitRecherche; 
use App\Repository\ProduitRepository;
use Symfony\Component\Form\AbstractType; 
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; 
use Symfony\Component\OptionsResolver\OptionsResolver; 
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RangeType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType; 

class ProduitRechercheType extends AbstractType
{
    /***************************
     * Attributes
     **************************/

    /**
     * @var ProduitRepository
     */
    private $produitRepository;

    /***************************
     * Accessors
     **************************/

    /**
     * @return ProduitRepository
     */
    public function getRepository(): ProduitRepository
    {
        return $this->produitRepository;
    }

    /***************************
     * Special's methods
     **************************/

    /** 
     * @param ProduitRepository $produitRepository
     */
    public function __construct(ProduitRepository $produitRepository)
    {
        $this->produitRepository = $produitRepository;
    }

    /***************************
     * Methods
     **************************/

    public function buildForm(FormBuilderInterface $builder, array $options ): void
    { 
        $data = $this->getRepository()->getMinAndMax();  
        $builder
        /*->add('produitRef', ChoiceType::class,[
            'data' => Produit::class,   
            'label' => 'Référence', 
            'choice_label' => function (?Produit $entity) { 
                return $entity ? $entity->getProduitRef() : '';
            }, 
            'choice_value' => function (?Produit $entity) { 
                return $entity ? $entity->getProduitRef() : '';
            },
            'expanded' => true, 
            'multiple' => true,
            'required' => false,
            'mapped' => false 
        ])*/
        ->add('recherche', TextType::class,[
            'label' => 'Rechercher',
            'required' => false,
            'attr' => [
                'placeholder' => 'Votre recherche...',
                'class' => 'form-control-sm'
            ]
        ])
        ->add('categories', EntityType::class, [
            'label' => false,
            'required' => false,
            'class' => Categories::class,
            'multiple' => true,
            'expanded' => true
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Filtrer',
            'attr' => [
                'class' => 'btn-block btn-info'
            ]
        ])
        ->add('produitPrix', RangeType::class, [   
            'data' => Produit::class,
            'attr' => [
                'min' => $data['MIN'],
                'max' => $data['MAX']
            ],
            'required' => false,
            'mapped' => false 
        ]) ;
        /*$builder
        ->add('marques', EntityType::class, [
            'class' => Produit::class,
            'label' => 'Marques',  
            'choice_label' => function (?Produit $entity) { 
                return $entity ? $entity->getMarques()->getMarqueNom() : '';
            },
            'choice_value' => function (?Produit $entity) {
                return $entity ? $entity->getMarques()->getId() : '';
            },
            'expanded' => true,
            'multiple' => true,
            'required' => false, 
            'mapped' => false 
        ])  ;
 
        ->add('couleurs', EntityType::class, [
            'class' => Produit::class,
            'choice_value' => function (?Produit $entity) {
                return $entity ? $entity->getCouleur()->getCouleurNom() : '';
            },
            'choice_label' => function (?Produit $entity) {
                return $entity ? $entity->getCouleur()->getCouleurNom() : '';
            }, 
            'expanded' => true,
            'multiple' => true,
            'required' => false,
            'mapped' => false 
        ]);*/

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProduitRecherche::class,
            'method' => 'GET',
            'crsf_protection' => false,
        ]);
    }

        public function getBlockPrefix()
    {
        return '';
    }
}


