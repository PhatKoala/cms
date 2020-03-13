<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use PhatKoala\CoreBundle\Entity\Traits\Prioritise;
use PhatKoala\CoreBundle\Entity\Traits\Timestampable;
use PhatKoala\CoreBundle\Entity\Traits\Tree;

/**
 * @ORM\Entity(repositoryClass="PhatKoala\CmsBundle\Repository\TermRepository")
 * @Gedmo\Tree()
 */
class Term
{
    use Prioritise, Timestampable, Tree;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity="Taxonomy")
     * @ORM\JoinColumn(name="type", referencedColumnName="type")
     */
    private Taxonomy $taxonomy;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private string $description = '';

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=true)
     */
    private ?string $slug = null;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private string $status = 'publish';

    /**
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="Term")
     * @ORM\JoinColumn(name="tree_root", referencedColumnName="id")
     */
    private ?Term $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Term", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private ?Term $parent;

    /**
     * @var Collection<Term>
     *
     * @ORM\OneToMany(targetEntity="Term", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private Collection $children;

    public function __construct(Taxonomy $taxonomy, string $name)
    {
        $this->setTaxonomy($taxonomy);
        $this->setName($name);
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaxonomy(): Taxonomy
    {
        return $this->taxonomy;
    }

    public function setTaxonomy(Taxonomy $taxonomy): void
    {
        $this->taxonomy = $taxonomy;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getRoot(): ?Term
    {
        return $this->root;
    }

    public function setRoot(?Term $root): void
    {
        $this->root = $root;
    }

    public function getParent(): ?Term
    {
        return $this->parent;
    }

    public function setParent(?Term $parent): void
    {
        $this->parent = $parent;
    }

    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function setChildren(Collection $children): void
    {
        $this->children = $children;
    }
}
