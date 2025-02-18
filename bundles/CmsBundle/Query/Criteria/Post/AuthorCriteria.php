<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Query\Criteria\Post;

use Doctrine\ORM\QueryBuilder;
use PhatKoala\CmsBundle\Entity\User;

class AuthorCriteria
{
    private ?User $equal = null;
    private ?User $notEqual = null;
    private array $in = [ ];
    private array $notIn = [ ];

    public function build(QueryBuilder $build)
    {

    }

    public function equal(?User $author)
    {
        $this->equal = $author;
    }

    public function notEqual(?User $author)
    {
        $this->notEqual = $author;
    }

    public function in(array $in)
    {
        $this->in = $in;
    }

    public function notIn(array $notIn)
    {
        $this->notIn = $notIn;
    }
}
