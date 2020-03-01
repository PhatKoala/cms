<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\Content;
use App\Entity\Traits\Id;
use App\Entity\Traits\Prioritise;
use App\Entity\Traits\Sluggable;
use App\Entity\Traits\Status;
use App\Entity\Traits\Timestampable;
use App\Entity\Traits\Title;
use App\Entity\Traits\Tree;
use App\Entity\Traits\Type;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaxonomyRepository")
 * @Gedmo\Tree()
 */
class Taxonomy
{
    use Id, Type, Status, Title, Content,
        Prioritise, Sluggable, Timestampable, Tree;

    /**
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="Taxonomy")
     * @ORM\JoinColumn(name="tree_root", referencedColumnName="id")
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Taxonomy", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Taxonomy", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;

    /**
     * @return mixed
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @param mixed $root
     */
    public function setRoot($root): void
    {
        $this->root = $root;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return mixed
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param mixed $children
     */
    public function setChildren($children): void
    {
        $this->children = $children;
    }
}
