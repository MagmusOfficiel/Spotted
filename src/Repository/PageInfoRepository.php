<?php

namespace App\Repository;

use App\Entity\PageInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PageInfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageInfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageInfo[]    findAll()
 * @method PageInfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageInfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PageInfo::class);
    }

    // /**
    //  * @return PageInfo[] Returns an array of PageInfo objects
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
    public function findOneBySomeField($value): ?PageInfo
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
