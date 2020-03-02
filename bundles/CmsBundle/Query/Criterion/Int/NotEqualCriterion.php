<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Query\Criterion\Int;

trait NotEqualCriterion
{
    private ?int $notEqual = null;

    public function notEqual(int $id)
    {
        $this->notEqual = $id;
    }
}