<?php

namespace App\Repository;

use App\Entity\Feeds;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Feeds|null find($id, $lockMode = null, $lockVersion = null)
 * @method Feeds|null findOneBy(array $criteria, array $orderBy = null)
 * @method Feeds[]    findAll()
 * @method Feeds[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeedsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Feeds::class);
    }

    // /**
    //  * @return Feeds[] Returns an array of Feeds objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Feeds
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
