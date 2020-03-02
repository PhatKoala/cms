<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Query\Criteria\Post;

use PhatKoala\CmsBundle\Query\Criterion\Int\EqualCriterion;
use PhatKoala\CmsBundle\Query\Criterion\Int\InCriterion;
use PhatKoala\CmsBundle\Query\Criterion\Int\NotEqualCriterion;
use PhatKoala\CmsBundle\Query\Criterion\Int\NotInCriterion;
use Doctrine\ORM\QueryBuilder;

class ParentCriteria
{
    use EqualCriterion, NotEqualCriterion,
        InCriterion, NotInCriterion;

    public function build(QueryBuilder $builder)
    {
        if (!is_null($this->equal)) {
            $builder->andWhere($builder->expr()->eq('post.id', $builder->expr()->literal($this->equal)));
        }

        if (!is_null($this->notEqual)) {
            $builder->andWhere($builder->expr()->neq('post.id', $builder->expr()->literal($this->notEqual)));
        }

        if (!empty($this->in)) {
            $builder->andWhere($builder->expr()->in('post.id', $this->in));
        }

        if (!empty($this->notIn)) {
            $builder->andWhere($builder->expr()->notIn('post.id', $this->notIn));
        }
    }
}