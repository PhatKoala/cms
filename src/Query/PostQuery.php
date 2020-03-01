<?php

declare(strict_types=1);

namespace App\Query;

use App\Query\Criteria\Post\AuthorCriteria;
use App\Query\Criteria\Post\IdCriteria;
use App\Query\Criteria\Post\ParentCriteria;
use App\Query\Criteria\Post\SlugCriteria;
use App\Query\Criteria\Post\TaxonomyCriteria;
use App\Query\Criteria\Post\TitleCriteria;
use App\Query\Criteria\Post\TypeCriteria;
use Doctrine\ORM\QueryBuilder;

class PostQuery
{
    private IdCriteria $id;
    private TypeCriteria $type;
    private ParentCriteria $parent;
    private TitleCriteria $title;
    private SlugCriteria $slug;
    private AuthorCriteria $author;
    private TaxonomyCriteria $taxonomy;

    public function __construct(array $criteria = null)
    {
        $this->id = new IdCriteria();
        $this->type = new TypeCriteria();
        $this->parent = new ParentCriteria();
        $this->title = new TitleCriteria();
        $this->slug = new SlugCriteria();
        $this->author = new AuthorCriteria();
        $this->taxonomy = new TaxonomyCriteria();

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

    public function author()
    {
        return $this->author;
    }

    public function taxonomy()
    {
        return $this->taxonomy;
    }
}
