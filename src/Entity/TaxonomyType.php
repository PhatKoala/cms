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
 * @ORM\Entity(repositoryClass="App\Repository\TaxonomyTypeRepository")
 */
class TaxonomyType
{
    use IdType, Title, Plural, Icon,
        IsHierarchical,
        HasUi;

    /**
     * @ORM\Column(type="array")
     */
    private array $taxonomies = [ ];

    public function __construct()
    {
        $this->icon = 'fa fa-folder';
    }

    /**
     * @return array
     */
    public function getTaxonomies(): array
    {
        return $this->taxonomies;
    }

    /**
     * @param array $taxonomies
     */
    public function setTaxonomies(array $taxonomies): void
    {
        $this->taxonomies = $taxonomies;
    }
}
