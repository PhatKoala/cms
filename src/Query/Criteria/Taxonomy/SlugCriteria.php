<?php

declare(strict_types=1);

namespace App\Query\Criteria\Taxonomy;

use App\Query\CriteriaArrayInterface;
use App\Query\CriteriaBuilderInterface;
use App\Query\Criterion\String\EqualCriterion;
use App\Query\Criterion\String\InCriterion;
use App\Query\Criterion\String\NotEqualCriterion;
use App\Query\Criterion\String\NotInCriterion;
use Doctrine\ORM\QueryBuilder;

class SlugCriteria implements CriteriaArrayInterface, CriteriaBuilderInterface
{
    use EqualCriterion, NotEqualCriterion,
        InCriterion, NotInCriterion;

    public function criteria(array $criteria)
    {
        if (isset($criteria['slug']) && is_string($criteria['slug'])) {
            $this->equal($criteria['slug']);
        }
    }

    public function build(QueryBuilder $builder)
    {
        if (!is_null($this->equal)) {
            $builder->andWhere($builder->expr()->eq('taxonomy.slug', $builder->expr()->literal($this->equal)));
        }

        if (!is_null($this->notEqual)) {
            $builder->andWhere($builder->expr()->neq('taxonomy.slug', $builder->expr()->literal($this->notEqual)));
        }

        if (!empty($this->in)) {
            $builder->andWhere($builder->expr()->in('taxonomy.slug', $this->in));
        }

        if (!empty($this->notIn)) {
            $builder->andWhere($builder->expr()->notIn('taxonomy.slug', $this->notIn));
        }
    }
}