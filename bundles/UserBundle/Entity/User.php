<?php

declare(strict_types=1);

namespace PhatKoala\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use PhatKoala\CoreBundle\Entity\Traits\Timestampable;

/**
 * @ORM\Entity(repositoryClass="PhatKoala\UserBundle\Repository\UserRepository")
 */
class User
{
    use Timestampable;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private ?UserType $type;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private ?string $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param UserType $type
     * @return $this
     */
    public function setType(UserType $type): self
    {
        $this->type = $type;

        return $this;
    }

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
