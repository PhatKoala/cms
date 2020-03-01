<?php

declare(strict_types=1);

namespace App\Query\Criterion\String;

trait NotEqualCriterion
{
    private ?string $notEqual = null;

    public function notEqual(string $id)
    {
        $this->notEqual = $id;
    }
}