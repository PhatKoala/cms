<?php

declare(strict_types=1);

namespace App\Query;

use App\Query\Criteria\Taxonomy\IdCriteria;
use App\Query\Criteria\Taxonomy\ParentCriteria;
use App\Query\Criteria\Taxonomy\SlugCriteria;
use App\Query\Criteria\Taxonomy\TitleCriteria;
use App\Query\Criteria\Taxonomy\TypeCriteria;
use Doctrine\ORM\QueryBuilder;

class TaxonomyQuery
{
    private IdCriteria $id;
    private TypeCriteria $type;
    private ParentCriteria $parent;
    private TitleCriteria $title;
    private SlugCriteria $slug;

    public function __construct(array $criteria = null)
    {
        $this->id = new IdCriteria();
        $this->type = new TypeCriteria();
        $this->parent = new ParentCriteria();
        $this->title = new TitleCriteria();
        $this->slug = new SlugCriteria();

        if (is_array($criteria)) {
            $this->criteria($criteria);
        }
    }

    public function criteria(array $criteria)
    {
        foreach (get_object_vars($this) as $property) {
            if (is_object($property) && $property instanceof CriteriaArrayInterface) {
                $property->criteria($criteria);
            }
        }
    }

    public function build(QueryBuilder $builder)
    {
        foreach (get_object_vars($this) as $property) {
            if (is_object($property) && $property instanceof CriteriaBuilderInterface) {
                $property->build($builder);
            }
        }

        return $builder;
    }

    public function id()
    {
        return $this->id;
    }

    public function type()
    {
        return $this->type;
    }
}