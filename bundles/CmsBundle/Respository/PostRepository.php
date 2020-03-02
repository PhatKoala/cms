<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Repository;

use PhatKoala\CmsBundle\Entity\Post;
use PhatKoala\CmsBundle\Query\PostQuery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, EventDispatcherInterface $dispatcher)
    {
        parent::__construct($registry, Post::class);
    }

    public function query(PostQuery $query)
    {
        $builder = $this->createQueryBuilder('post');
        $query->build($builder);

        return $builder
            ->getQuery()
            ->getResult();
    }

    public function save(Post $post, $flush = true)
    {
        $manager = $this->getEntityManager();
        $manager->persist($post);

        if (true == $flush) {
            $manager->flush();
        }
    }
}
