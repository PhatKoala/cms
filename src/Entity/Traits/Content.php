<?php

declare(strict_types=1);

namespace App\Entity\Traits;

trait Content
{
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
}