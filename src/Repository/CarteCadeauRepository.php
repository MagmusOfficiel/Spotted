<?php

namespace App\Repository;

use App\Entity\CarteCadeau;
use Doctrine\ORM\Query; 
use App\Entity\ProduitRecherche;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method CarteCadeau|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteCadeau|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteCadeau[]    findAll()
 * @method CarteCadeau[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteCadeauRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarteCadeau::class);
    }

    public function countCarteCadeau()
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
     * @param array $refs
     * @param array $cats
     * @return Query
     */
    public function findAllWithPagination(array $options) : Query
    {
        $qb = $this->createQueryBuilder('v'); 
         
        if ( \count($options['refs']) > 0 ) {
            $qb->where(
                $qb->expr()->in('v.produitRef', ':refs')
            )
            ->setParameter('refs', $options['refs']); 
        }
        
        if ( 0 !== $options['prixMax'] ) {
            $qb->andWhere('v.produitPrix <= :max')
                ->setParameter('max', $options['prixMax']);
        }
 
        if ( \count($options['cats']) > 0 ) {
            $qb->andWhere(
                $qb->expr()->in('v.categories', ':cats')
            )
            ->setParameter('cats', $options['cats']); 
        } 
        return $qb->getQuery();
        
    }
    
    /** 
     * @return iterable
     */
    public function getMinAndMax(): iterable
    {
        $qb = $this->createQueryBuilder('p'); 
        return $qb->select($qb->expr()->min('p.cartecadeauPrix').'as MIN')  
                    ->addSelect($qb->expr()->max('p.cartecadeauPrix').'as MAX')  
                    ->getQuery()
                    ->getSingleResult(Query::HYDRATE_ARRAY); 
    }

    
    // /**
    //  * @return CarteCadeau[] Returns an array of CarteCadeau objects
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
