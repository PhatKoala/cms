<?php

declare(strict_types=1);

namespace App\Entity\Traits;

trait Excerpt
{
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $excerpt = null;

    public function getExcerpt(): ?string
    {
        return $this->excerpt;
    }

    public function setExcerpt(?string $excerpt): self
    {
        $this->excerpt = $excerpt;

        return $this;
    }
}
