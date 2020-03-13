<?php

declare(strict_types=1);

namespace PhatKoala\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
    private ?string $type = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $name = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $plural = null;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private ?string $icon = 'fa fa-user';

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
    private ArrayCollection $demographics;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPlural(): ?string
    {
        return $this->plural;
    }

    public function setPlural(?string $plural): self
    {
        $this->plural = $plural;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function hasUi(): ?bool
    {
        return $this->ui;
    }

    public function setUi(bool $ui): self
    {
        $this->ui = $ui;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getDemographics(): ArrayCollection
    {
        return $this->demographics;
    }

    /**
     * @param ArrayCollection $demographics
     */
    public function setDemographics(ArrayCollection $demographics): void
    {
        $this->demographics = $demographics;
    }
}
