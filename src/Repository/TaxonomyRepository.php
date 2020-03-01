<?php

namespace App\Repository;

use App\Entity\Taxonomy;
use App\Query\TaxonomyQuery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Taxonomy|null find($id, $lockMode = null, $lockVersion = null)
 * @method Taxonomy|null findOneBy(array $criteria, array $orderBy = null)
 * @method Taxonomy[]    findAll()
 * @method Taxonomy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaxonomyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Taxonomy::class);
    }

    public function query(TaxonomyQuery $query)
    {
        $builder = $this->createQueryBuilder('taxonomy');
        $query->build($builder);

        return $builder
            ->getQuery()
            ->getResult();
    }

    public function save(Taxonomy $taxonomy, $flush = true)
    {
        $manager = $this->getEntityManager();
        $manager->persist($taxonomy);

        if (true == $flush) {
            $manager->flush();
        }
    }
}
