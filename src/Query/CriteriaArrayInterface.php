<?php

declare(strict_types=1);

namespace App\Query;

interface CriteriaArrayInterface
{
    public function criteria(array $criteria);
}