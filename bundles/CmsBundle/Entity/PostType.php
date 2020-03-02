<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Entity;

use PhatKoala\CmsBundle\Entity\Traits\HasUi;
use PhatKoala\CmsBundle\Entity\Traits\Icon;
use PhatKoala\CmsBundle\Entity\Traits\IsHierarchical;
use PhatKoala\CmsBundle\Entity\Traits\Plural;
use PhatKoala\CmsBundle\Entity\Traits\Title;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PhatKoala\CmsBundle\Repository\PostTypeRepository")
 */
class PostType
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=100)
     */
    private ?string $type = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $title = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $plural = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $icon = null;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $hierarchical = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $ui = false;

    public function __toString()
    {
        return $this->type;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @ORM\Column(type="array")
     */
    private array $taxonomies = [ ];

    public function __construct()
    {
        $this->icon = 'fa fa-page';
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

    public function getPlural(): ?string
    {
        return $this->plural;
    }

    public function setPlural(?string $plural): self
    {
        $this->plural = $plural;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function hasUi(): ?bool
    {
        return $this->ui;
    }

    public function setUi(bool $ui): self
    {
        $this->ui = $ui;

        return $this;
    }

    public function isHierarchical(): ?bool
    {
        return $this->hierarchical;
    }

    public function setHierarchical(bool $hierarchical): self
    {
        $this->hierarchical = $hierarchical;

        return $this;
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
