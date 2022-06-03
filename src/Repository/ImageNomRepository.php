<?php

namespace App\Repository;

use App\Entity\ImageNom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImageNom|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageNom|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageNom[]    findAll()
 * @method ImageNom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageNomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageNom::class);
    }

    // /**
    //  * @return ImageNom[] Returns an array of ImageNom objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ImageNom
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
