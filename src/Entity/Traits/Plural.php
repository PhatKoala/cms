<?php

declare(strict_types=1);

namespace App\Entity\Traits;

trait Plural
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $plural = null;

    public function getPlural(): ?string
    {
        return $this->plural;
    }

    public function setPlural(?string $plural): self
    {
        $this->plural = $plural;

        return $this;
    }
}