<?php

namespace App\Repository;

use App\Entity\Hebergeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Hebergeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hebergeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hebergeur[]    findAll()
 * @method Hebergeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HebergeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hebergeur::class);
    }

    // /**
    //  * @return Hebergeur[] Returns an array of Hebergeur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Hebergeur
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
