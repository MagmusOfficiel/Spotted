<?php

namespace App\Repository;

use App\Entity\CarteCadeauEnvoie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CarteCadeauEnvoie|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteCadeauEnvoie|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteCadeauEnvoie[]    findAll()
 * @method CarteCadeauEnvoie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteCadeauEnvoieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarteCadeauEnvoie::class);
    }

    // /**
    //  * @return CarteCadeauEnvoie[] Returns an array of CarteCadeauEnvoie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CarteCadeauEnvoie
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
