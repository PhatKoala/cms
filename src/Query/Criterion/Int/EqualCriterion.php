<?php

declare(strict_types=1);

namespace App\Query\Criterion\Int;

trait EqualCriterion
{
    private ?int $equal = null;

    public function equal(int $id)
    {
        $this->equal = $id;
    }
}