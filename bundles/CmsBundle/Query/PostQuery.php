<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Query;

use PhatKoala\CmsBundle\Query\Criteria\Post\AuthorCriteria;
use PhatKoala\CmsBundle\Query\Criteria\Post\IdCriteria;
use PhatKoala\CmsBundle\Query\Criteria\Post\ParentCriteria;
use PhatKoala\CmsBundle\Query\Criteria\Post\SlugCriteria;
use PhatKoala\CmsBundle\Query\Criteria\Post\TaxonomyCriteria;
use PhatKoala\CmsBundle\Query\Criteria\Post\TitleCriteria;
use PhatKoala\CmsBundle\Query\Criteria\Post\TypeCriteria;
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
