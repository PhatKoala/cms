<?php

declare(strict_types=1);

namespace App\Entity\Traits;

trait IsHierarchical
{
    /**
     * @ORM\Column(type="boolean")
     */
    private bool $hierarchical = false;

    public function isHierarchical(): ?bool
    {
        return $this->hierarchical;
    }

    public function setHierarchical(bool $hierarchical): self
    {
        $this->hierarchical = $hierarchical;

        return $this;
    }
}