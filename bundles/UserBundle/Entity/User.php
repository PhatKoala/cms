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
     * @ORM\ManyToOne(targetEntity="UserType")
     * @ORM\JoinColumn(name="type", referencedColumnName="type")
     */
    private UserType $type;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private string $status = 'active';

    public function __construct(UserType $type)
    {
        $this->type = $type;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): UserType
    {
        return $this->type;
    }

    public function setType(UserType $type): void
    {
        $this->type = $type;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}
