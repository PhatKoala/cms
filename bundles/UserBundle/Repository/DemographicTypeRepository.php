<?php

namespace App\Repository;

use App\Entity\DemographicType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DemographicType|null find($id, $lockMode = null, $lockVersion = null)
 * @method DemographicType|null findOneBy(array $criteria, array $orderBy = null)
 * @method DemographicType[]    findAll()
 * @method DemographicType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemographicTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DemographicType::class);
    }

    // /**
    //  * @return DemographicType[] Returns an array of DemographicType objects
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
    public function findOneBySomeField($value): ?DemographicType
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
