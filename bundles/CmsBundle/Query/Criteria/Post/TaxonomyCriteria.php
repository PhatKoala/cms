<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Query\Criteria\Post;

use PhatKoala\CmsBundle\Query\Criterion\EqualIntCriterion;
use PhatKoala\CmsBundle\Query\Criterion\InCriterion;
use PhatKoala\CmsBundle\Query\Criterion\NotEqualCriterion;
use PhatKoala\CmsBundle\Query\Criterion\NotInCriterion;
use Doctrine\ORM\QueryBuilder;

class TaxonomyCriteria
{
    public function build(QueryBuilder $build)
    {

    }
}