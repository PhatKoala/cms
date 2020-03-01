<?php

declare(strict_types=1);

namespace App\Query\Criterion;

trait NullCriterion
{
    private ?bool $isNull = null;

    public function null(?bool $isNull)
    {
        $this->isNull = $isNull;
    }
}