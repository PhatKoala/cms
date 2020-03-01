<?php

declare(strict_types=1);

namespace App\Query\Criteria\Post;

use App\Query\Criterion\EqualIntCriterion;
use App\Query\Criterion\InCriterion;
use App\Query\Criterion\NotEqualCriterion;
use App\Query\Criterion\NotInCriterion;
use Doctrine\ORM\QueryBuilder;

class TaxonomyCriteria
{
    public function build(QueryBuilder $build)
    {

    }
}