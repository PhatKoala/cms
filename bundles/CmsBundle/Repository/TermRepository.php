<?php

namespace PhatKoala\CmsBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use PhatKoala\CmsBundle\Entity\Term;
use PhatKoala\CmsBundle\Query\TaxonomyQuery;

/**
 * @method Term|null find($id, $lockMode = null, $lockVersion = null)
 * @method Term|null findOneBy(array $criteria, array $orderBy = null)
 * @method Term[]    findAll()
 * @method Term[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TermRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Term::class);
    }

    public function query(TaxonomyQuery $query)
    {
        $builder = $this->createQueryBuilder('term');
        $query->build($builder);

        return $builder
            ->getQuery()
            ->getResult();
    }

    public function save(Term $term, $flush = true)
    {
        $manager = $this->getEntityManager();
        $manager->persist($term);

        if (true == $flush) {
            $manager->flush();
        }
    }
}
