<?php

namespace App\Repository;

use App\Entity\Typehm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Typehm|null find($id, $lockMode = null, $lockVersion = null)
 * @method Typehm|null findOneBy(array $criteria, array $orderBy = null)
 * @method Typehm[]    findAll()
 * @method Typehm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypehmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Typehm::class);
    }

    // /**
    //  * @return Typehm[] Returns an array of Typehm objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Typehm
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
