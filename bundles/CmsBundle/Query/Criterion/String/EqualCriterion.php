<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Query\Criterion\String;

trait EqualCriterion
{
    private ?string $equal = null;

    public function equal(string $id)
    {
        $this->equal = $id;
    }
}