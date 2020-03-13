<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use PhatKoala\CoreBundle\Entity\Traits\Prioritise;
use PhatKoala\CoreBundle\Entity\Traits\Sluggable;
use PhatKoala\CoreBundle\Entity\Traits\Timestampable;
use PhatKoala\CoreBundle\Entity\Traits\Tree;

/**
 * @ORM\Entity(repositoryClass="PhatKoala\CmsBundle\Repository\PostRepository")
 * @Gedmo\Tree()
 */
class Post
{
    use Prioritise, Sluggable, Timestampable, Tree;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity="PostType")
     * @ORM\JoinColumn(name="type", referencedColumnName="type")
     */
    private PostType $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $title = '';

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private string $content = '';

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private string $excerpt = '';

    /**
     * @ORM\Column(type="string", length=64)
     */
    private string $status = 'publish';

    /**
     * @var Collection<Term>
     *
     * @ORM\ManyToMany(targetEntity="Term")
     * @ORM\JoinTable(name="post_term",
     *     joinColumns={@ORM\JoinColumn(name="post", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="term", referencedColumnName="id")}
     * )
     */
    private Collection $terms;

    /**
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="Post")
     * @ORM\JoinColumn(name="tree_root", referencedColumnName="id")
     */
    private ?Post $root = null;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private ?Post $parent = null;

    /**
     * @var Collection<Term>
     *
     * @ORM\OneToMany(targetEntity="Post", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private Collection $children;

    public function __construct(PostType $type)
    {
        $this->type = $type;

        $this->terms = new ArrayCollection();
        $this->children = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): PostType
    {
        return $this->type;
    }

    public function setType(PostType $type): void
    {
        $this->type = $type;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getExcerpt(): string
    {
        return $this->excerpt;
    }

    public function setExcerpt(string $excerpt): void
    {
        $this->excerpt = $excerpt;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getTerms(): Collection
    {
        return $this->terms;
    }

    public function setTerms(Collection $terms): void
    {
        $this->terms = $terms;
    }

    public function getRoot(): ?Post
    {
        return $this->root;
    }

    public function setRoot(?Post $root): void
    {
        $this->root = $root;
    }

    public function getParent(): ?Post
    {
        return $this->parent;
    }

    public function setParent(?Post $parent): void
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
