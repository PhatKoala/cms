<?php

declare(strict_types=1);

namespace App\Query\Criteria\Post;

use App\Query\CriteriaArrayInterface;
use App\Query\CriteriaBuilderInterface;
use App\Query\Criterion\String\EqualCriterion;
use App\Query\Criterion\String\InCriterion;
use App\Query\Criterion\String\NotEqualCriterion;
use App\Query\Criterion\String\NotInCriterion;
use Doctrine\ORM\QueryBuilder;

class TypeCriteria implements CriteriaArrayInterface, CriteriaBuilderInterface
{
    use EqualCriterion, NotEqualCriterion,
        InCriterion, NotInCriterion;

    public function criteria(array $criteria)
    {
        if (isset($criteria['type']) && (is_string($criteria['type']) || (is_object($criteria['type']) && method_exists($criteria['type'], '__toString')))) {
            $this->equal((string) $criteria['type']);
        }
    }

    public function build(QueryBuilder $builder)
    {
        if (!is_null($this->equal)) {
            $builder->andWhere($builder->expr()->eq('post.type', $builder->expr()->literal($this->equal)));
        }

        if (!is_null($this->notEqual)) {
            $builder->andWhere($builder->expr()->neq('post.type', $builder->expr()->literal($this->notEqual)));
        }

        if (!empty($this->in)) {
            $builder->andWhere($builder->expr()->in('post.type', $this->in));
        }

        if (!empty($this->notIn)) {
            $builder->andWhere($builder->expr()->notIn('post.type', $this->notIn));
        }
    }
}