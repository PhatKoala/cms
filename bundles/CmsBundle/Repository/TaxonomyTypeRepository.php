<?php

namespace PhatKoala\CmsBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use PhatKoala\CmsBundle\Entity\TaxonomyType;

/**
 * @method TaxonomyType|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaxonomyType|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaxonomyType[]    findAll()
 * @method TaxonomyType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaxonomyTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaxonomyType::class);
    }

    public function save(TaxonomyType $type, $flush = true)
    {
        $manager = $this->getEntityManager();
        $manager->persist($type);

        if (true == $flush) {
            $manager->flush();
        }
    }
}
