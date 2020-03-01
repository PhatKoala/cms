<?php

declare(strict_types=1);

namespace App\Entity\Traits;

trait Icon
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $icon = null;

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }
}
