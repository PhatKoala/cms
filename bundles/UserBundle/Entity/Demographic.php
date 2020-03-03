<?php

declare(strict_types=1);

namespace PhatKoala\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use PhatKoala\CoreBundle\Entity\Traits\Prioritise;
use PhatKoala\CoreBundle\Entity\Traits\Sluggable;
use PhatKoala\CoreBundle\Entity\Traits\Timestampable;
use PhatKoala\CoreBundle\Entity\Traits\Tree;

/**
 * @ORM\Entity(repositoryClass="PhatKoala\UserBundle\Repository\DemographicRepository")
 * @Gedmo\Tree()
 */
class Demographic
{
    use Prioritise, Sluggable, Timestampable, Tree;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private ?string $type;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private ?string $status = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $title = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $content = null;

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="Demographic")
     * @ORM\JoinColumn(name="tree_root", referencedColumnName="id")
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Demographic", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Demographic", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|object $type
     * @return $this
     */
    public function setType($type): self
    {
        if (is_string($type) || (is_object($type) && method_exists($type, '__toString' ))) {
            $this->type = (string) $type;
        }

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

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
