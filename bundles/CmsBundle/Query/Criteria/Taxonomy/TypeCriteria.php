<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Query\Criteria\Taxonomy;

use Doctrine\ORM\QueryBuilder;
use PhatKoala\CmsBundle\Query\CriteriaArrayInterface;
use PhatKoala\CmsBundle\Query\CriteriaBuilderInterface;
use PhatKoala\CmsBundle\Query\Criterion\String\EqualCriterion;
use PhatKoala\CmsBundle\Query\Criterion\String\InCriterion;
use PhatKoala\CmsBundle\Query\Criterion\String\NotEqualCriterion;
use PhatKoala\CmsBundle\Query\Criterion\String\NotInCriterion;

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
            $builder->andWhere($builder->expr()->eq('taxonomy.type', $builder->expr()->literal($this->equal)));
        }

        if (!is_null($this->notEqual)) {
            $builder->andWhere($builder->expr()->neq('taxonomy.type', $builder->expr()->literal($this->notEqual)));
        }

        if (!empty($this->in)) {
            $builder->andWhere($builder->expr()->in('taxonomy.type', $this->in));
        }

        if (!empty($this->notIn)) {
            $builder->andWhere($builder->expr()->notIn('taxonomy.type', $this->notIn));
        }
    }
}