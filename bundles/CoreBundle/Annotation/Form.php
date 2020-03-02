<?php

declare(strict_types=1);

namespace PhatKoala\CoreBundle\Annotation;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;

/**
 * @Annotation
 */
class Form implements ConfigurationInterface
{
    /**
     * @psalm-suppress PropertyNotSetInConstructor
     * @required
     */
    public string $class;

    /** @psalm-suppress PropertyNotSetInConstructor */
    public ?string $data = null;

    /** @psalm-suppress PropertyNotSetInConstructor */
    public ?array $options = null;

    public function getAliasName(): string
    {
        return 'form';
    }

    public function allowArray(): bool
    {
        return false;
    }
}
