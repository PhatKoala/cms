<?php

declare(strict_types=1);

namespace App\Query\Criteria\Post;

use App\Entity\User;
use Doctrine\ORM\QueryBuilder;

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
