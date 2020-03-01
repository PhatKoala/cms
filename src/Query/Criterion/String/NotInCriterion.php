<?php

declare(strict_types=1);

namespace App\Query\Criterion\String;

trait NotInCriterion
{
    private ?array $notIn = null;

    public function notIn(array $ids)
    {
        $this->notIn = array_unique(array_map('strval', $ids));
    }
}