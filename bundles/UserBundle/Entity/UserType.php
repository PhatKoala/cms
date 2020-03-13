<?php

declare(strict_types=1);

namespace PhatKoala\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PhatKoala\UserBundle\Repository\UserTypeRepository")
 */
class UserType
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=100)
     */
    private string $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $plural;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private string $icon = 'fa fa-user';

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $ui = false;

    /**
     * @ORM\ManyToMany(targetEntity="Demographic")
     * @ORM\JoinTable(name="user_type_demographic_type",
     *     joinColumns={@ORM\JoinColumn(name="user_type", referencedColumnName="type")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="demographic_type", referencedColumnName="type")}
     * )
     */
    private Collection $demographics;

    public function __construct(string $type, string $name = '', string $plural = '')
    {
        $this->setType($type);

        if (empty($name)) {
            $name = ucfirst($type);
        }
        $this->setName($name);

        if (empty($plural)) {
            $plural = sprintf('%ss', $name);
        }
        $this->setPlural($plural);

        $this->demographics = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPlural(): string
    {
        return $this->plural;
    }

    public function setPlural(string $plural): void
    {
        $this->plural = $plural;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
    }

    public function hasUi(): bool
    {
        return $this->ui;
    }

    public function setUi(bool $ui): void
    {
        $this->ui = $ui;
    }

    public function getDemographics()
    {
        return $this->demographics;
    }

    public function setDemographics($demographics): void
    {
        $this->demographics = $demographics;
    }
}
