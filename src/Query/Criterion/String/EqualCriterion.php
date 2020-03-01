<?php

declare(strict_types=1);

namespace App\Query\Criterion\String;

trait EqualCriterion
{
    private ?string $equal = null;

    public function equal(string $id)
    {
        $this->equal = $id;
    }
}