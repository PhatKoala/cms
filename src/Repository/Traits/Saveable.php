<?php

declare(strict_types=1);

namespace App\Repository\Traits;

use Doctrine\ORM\EntityRepository;

trait Saveable
{
    public function save(object $entity): void
    {
        if ($this instanceof EntityRepository) {
            $em = $this->getEntityManager();
            $em->persist($entity);
            $em->flush();
        }
    }
}
