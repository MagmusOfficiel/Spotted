<?php

namespace App\Repository;

use App\Entity\Attributs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Attributs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Attributs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Attributs[]    findAll()
 * @method Attributs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttributsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Attributs::class);
    }

    // /**
    //  * @return Attributs[] Returns an array of Attributs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Attributs
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
