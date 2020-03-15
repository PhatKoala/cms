<?php

declare(strict_types=1);

namespace PhatKoala\CoreBundle\Event;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Contracts\EventDispatcher\Event;

class MainMenuEvent extends Event
{
    const CONFIGURE = 'core.main_menu';

    private FactoryInterface $factory;
    private  ItemInterface $menu;

    public function __construct(FactoryInterface $factory, ItemInterface $menu)
    {
        $this->factory = $factory;
        $this->menu = $menu;
    }

    public function getFactory(): FactoryInterface
    {
        return $this->factory;
    }

    public function getMenu(): ItemInterface
    {
        return $this->menu;
    }
}
