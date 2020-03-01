<?php

declare(strict_types=1);

namespace App\Entity\Traits;

trait IdType
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=100)
     */
    private ?string $type = null;

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
}