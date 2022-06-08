<?php

namespace App\Repository;

use App\Entity\Marque;
use Doctrine\ORM\Query;
use App\Entity\Produit; 
use App\Classe\Recherche;
use App\Classe\ProduitRecherche;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    public function countProduit()
    {
        return $this->createQueryBuilder('d')
            ->select('count(d.id) as count')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countMarques()
    {
        return $this->createQueryBuilder('d')
            ->select('count(DISTINCT d.marques) as count')
            ->getQuery()
            ->getSingleScalarResult();
    }


    /**
     * Filtre en fonction de la recherche
     *
     * @param ProduitRecherche $recherche
     * retour un object
     * 
     * @return void
     */
    public function findWithSearch(ProduitRecherche $recherche)
    {
        $query = $this
            ->createQueryBuilder('p')
            ->select('c', 'p')
            ->join('p.categories', 'c');

        if (!empty($recherche->categories)) {
            $query = $query
                ->andWhere('c.id IN (:categories)')
                ->setParameter('categories', $recherche->categories);
        }

        if (!empty($recherche->recherche)) {
            $query = $query
                ->andWhere('p.produitLibelle LIKE :recherche')
                ->setParameter('recherche', "%{$recherche->recherche}%");
                
        }
        if (!empty($recherche->prix)) {
            $query = $query
                ->andWhere('p.produitPrix <= :max')
                ->setParameter('max', $recherche->prix);
        }

        return $query->getQuery()->getResult();
    }
   
    /** 
     * @return iterable
     */
    public function getMinAndMax(): iterable
    {
        $qb = $this->createQueryBuilder('p'); 
        return $qb->select($qb->expr()->min('p.produitPrix').'as MIN')  
                    ->addSelect($qb->expr()->max('p.produitPrix').'as MAX')  
                    ->getQuery()
                    ->getSingleResult(Query::HYDRATE_ARRAY); 
    }

    
    // /**
    //  * @return Produit[] Returns an array of Produit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Produit
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
