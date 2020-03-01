<?php

declare(strict_types=1);

namespace App\Entity\Traits;

trait Type
{
    /**
     * @ORM\Column(type="string", length=128)
     */
    private ?string $type;

    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|object $type
     * @return $this
     */
    public function setType($type): self
    {
        if (is_string($type) || (is_object($type) && method_exists($type, '__toString' ))) {
            $this->type = (string) $type;
        }

        return $this;
    }
}
