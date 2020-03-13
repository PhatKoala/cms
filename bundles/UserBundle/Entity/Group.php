<?php

declare(strict_types=1);

namespace PhatKoala\UserBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use PhatKoala\CoreBundle\Entity\Traits\Prioritise;
use PhatKoala\CoreBundle\Entity\Traits\Sluggable;
use PhatKoala\CoreBundle\Entity\Traits\Timestampable;
use PhatKoala\CoreBundle\Entity\Traits\Tree;

/**
 * @ORM\Entity(repositoryClass="GroupRepository")
 * @Gedmo\Tree()
 */
class Group
{
    use Prioritise, Sluggable, Timestampable, Tree;

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
    private Demographic $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private string $description = '';

    /**
     * @ORM\Column(type="string", length=64)
     */
    private string $status = 'publish';

    /**
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="Group")
     * @ORM\JoinColumn(name="tree_root", referencedColumnName="id")
     */
    private ?Group $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Group", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private ?Group $parent;

    /**
     * @var Collection<Group>
     *
     * @ORM\OneToMany(targetEntity="Group", mappedBy="parent")
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

    public function getType(): Demographic
    {
        return $this->type;
    }

    public function setType(Demographic $type): void
    {
        $this->type = $type;
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

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getRoot(): ?Group
    {
        return $this->root;
    }

    public function setRoot(?Group $root): void
    {
        $this->root = $root;
    }

    public function getParent(): ?Group
    {
        return $this->parent;
    }

    public function setParent(?Group $parent): void
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
