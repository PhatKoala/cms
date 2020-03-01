<?php

declare(strict_types=1);

namespace App\Entity\Traits;

trait Status
{
    /**
     * @ORM\Column(type="string", length=64)
     */
    private ?string $status = null;

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
