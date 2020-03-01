<?php

declare(strict_types=1);

namespace App\Query;

use Doctrine\ORM\QueryBuilder;

interface CriteriaBuilderInterface
{
    public function build(QueryBuilder $builder);
}