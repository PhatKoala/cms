<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Query;

interface CriteriaArrayInterface
{
    public function criteria(array $criteria);
}