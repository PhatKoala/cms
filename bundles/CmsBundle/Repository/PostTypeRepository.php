<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use PhatKoala\CmsBundle\Entity\PostType;

/**
 * @method PostType|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostType|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostType[]    findAll()
 * @method PostType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostType::class);
    }

    public function save(PostType $type, $flush = true)
    {
        $manager = $this->getEntityManager();
        $manager->persist($type);

        if (true == $flush) {
            $manager->flush();
        }
    }
}
