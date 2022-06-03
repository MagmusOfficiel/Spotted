<?php

namespace App\Repository;

use App\Entity\SousSousCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SousSousCategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method SousSousCategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method SousSousCategorie[]    findAll()
 * @method SousSousCategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SousSousCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SousSousCategories::class);
    }

    public function deleteAllEmployees(){
        $query = $this->createQueryBuilder('e')
                 ->delete()
                 ->getQuery()
                 ->execute();
        return $query;
}
    // /**
    //  * @return SousSousCategorie[] Returns an array of SousSousCategorie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SousSousCategorie
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
