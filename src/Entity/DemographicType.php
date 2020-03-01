<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\HasUi;
use App\Entity\Traits\Icon;
use App\Entity\Traits\IdType;
use App\Entity\Traits\IsHierarchical;
use App\Entity\Traits\Plural;
use App\Entity\Traits\Title;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DemographicTypeRepository")
 */
class DemographicType
{
    use IdType, Title, Plural, Icon,
        IsHierarchical,
        HasUi;

    /**
     * @ORM\Column(type="array")
     */
    private array $demographics = [ ];

    public function __construct()
    {
        $this->icon = 'fa fa-user-tag';
    }

    /**
     * @return array
     */
    public function getDemographics(): array
    {
        return $this->demographics;
    }

    /**
     * @param array $demographics
     */
    public function setDemographics(array $demographics): void
    {
        $this->demographics = $demographics;
    }
}
