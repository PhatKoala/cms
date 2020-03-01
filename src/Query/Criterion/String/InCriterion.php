<?php

declare(strict_types=1);

namespace App\Query\Criterion\String;

trait InCriterion
{
    private ?array $in = null;

    public function in(array $ids)
    {
        $this->in = array_unique(array_map('strval', $ids));
    }
}