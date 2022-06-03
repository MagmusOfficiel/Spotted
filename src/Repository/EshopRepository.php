<?php

namespace App\Repository;

use App\Entity\Eshop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Eshop|null find($id, $lockMode = null, $lockVersion = null)
 * @method Eshop|null findOneBy(array $criteria, array $orderBy = null)
 * @method Eshop[]    findAll()
 * @method Eshop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EshopRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Eshop::class);
    }

    // /**
    //  * @return Eshop[] Returns an array of Eshop objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Eshop
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
