<?php

declare(strict_types=1);

namespace App\Entity\Traits;

trait HasUi
{
    /**
     * @ORM\Column(type="boolean")
     */
    private bool $ui = false;

    public function hasUi(): ?bool
    {
        return $this->ui;
    }

    public function setUi(bool $ui): self
    {
        $this->ui = $ui;

        return $this;
    }
}