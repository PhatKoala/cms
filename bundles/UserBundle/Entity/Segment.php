<?php

declare(strict_types=1);

namespace PhatKoala\UserBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use PhatKoala\CoreBundle\Entity\Traits\Prioritise;
use PhatKoala\CoreBundle\Entity\Traits\Timestampable;
use PhatKoala\CoreBundle\Entity\Traits\Tree;

/**
 * @ORM\Entity(repositoryClass="PhatKoala\UserBundle\Repository\SegmentRepository")
 * @Gedmo\Tree()
 */
class Segment
{
    use Prioritise, Timestampable, Tree;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity="Demographic")
     * @ORM\JoinColumn(name="type", referencedColumnName="type")
     */
    private Demographic $demographic;

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
     * @ORM\ManyToOne(targetEntity="Segment")
     * @ORM\JoinColumn(name="tree_root", referencedColumnName="id")
     */
    private ?Segment $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Segment", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private ?Segment $parent;

    /**
     * @var Collection<Segment>
     *
     * @ORM\OneToMany(targetEntity="Segment", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private Collection $children;

    public function __construct(Demographic $demographic, string $name)
    {
        $this->setDemographic($demographic);
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

    public function getDemographic(): Demographic
    {
        return $this->demographic;
    }

    public function setDemographic(Demographic $demographic): void
    {
        $this->demographic = $demographic;
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

    public function getRoot(): ?Segment
    {
        return $this->root;
    }

    public function setRoot(?Segment $root): void
    {
        $this->root = $root;
    }

    public function getParent(): ?Segment
    {
        return $this->parent;
    }

    public function setParent(?Segment $parent): void
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
