<?php

namespace App\Repository;

use App\Entity\Demographic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Demographic|null find($id, $lockMode = null, $lockVersion = null)
 * @method Demographic|null findOneBy(array $criteria, array $orderBy = null)
 * @method Demographic[]    findAll()
 * @method Demographic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemographicRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Demographic::class);
    }

    // /**
    //  * @return Demographic[] Returns an array of Demographic objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Demographic
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
