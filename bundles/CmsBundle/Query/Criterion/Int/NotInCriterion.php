<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Query\Criterion\Int;

trait NotInCriterion
{
    private ?array $notIn = null;

    public function notIn(array $ids)
    {
        $this->notIn = array_unique(array_map('intval', $ids));
    }
}