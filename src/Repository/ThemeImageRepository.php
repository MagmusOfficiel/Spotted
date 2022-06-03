<?php

namespace App\Repository;

use App\Entity\ThemeImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ThemeImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ThemeImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ThemeImage[]    findAll()
 * @method ThemeImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThemeImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ThemeImage::class);
    }

    // /**
    //  * @return ThemeImage[] Returns an array of ThemeImage objects
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
    public function findOneBySomeField($value): ?ThemeImage
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
