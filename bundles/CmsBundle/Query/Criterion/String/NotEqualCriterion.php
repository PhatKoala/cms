<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Query\Criterion\String;

trait NotEqualCriterion
{
    private ?string $notEqual = null;

    public function notEqual(string $id)
    {
        $this->notEqual = $id;
    }
}