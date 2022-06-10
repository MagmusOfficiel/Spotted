<?php

namespace App\Repository;

use App\Entity\Commande;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }

    /*
     * findSuccessOrders()
     * Permet d'afficher les commandes dans l'espace membre de l'utilisateur
     */
    public function findSuccessOrders($user)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.isPaye > 0')
            ->andWhere('o.utilisateur = :utilisateur')
            ->setParameter('utilisateur', $user)
            ->orderBy('o.id', 'DESC')
            ->getQuery()
            ->getResult();
    }
    /**
     * Retour les commandes selon une année
     *
     * @param int $dateRecup
     * Année des commandes
     * 
     * @return mixed
     */
    public function findStatsCommandeAnnee(int $dateRecup): mixed
    {   
        $dateModify = $dateRecup-1;
        return $this->createQueryBuilder('a')
            ->select('c')
            ->from(Commande::class, 'c')
            ->where('YEAR(c.createdAt) BETWEEN :dateModify AND :dateRecup')
            ->setParameter('dateRecup', $dateRecup)
            ->setParameter('dateModify', $dateModify)
            ->getQuery()
            ->getResult();
    } 

    // /**
    //  * @return Commande[] Returns an array of Commande objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Order
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
