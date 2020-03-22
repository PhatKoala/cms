<?php

declare(strict_types=1);

namespace PhatKoala\CoreBundle\Menu;

use Knp\Menu\FactoryInterface;
use PhatKoala\CoreBundle\Event\MainMenuEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class MainMenuBuilder
{
    public function build(EventDispatcherInterface $dispatcher, FactoryInterface $factory)
    {
        $menu = $factory
            ->createItem('Home', ['route' => 'dashboard'])
            ->setExtra('icon', 'home');

        $dispatcher->dispatch(
            new MainMenuEvent($factory, $menu), MainMenuEvent::CONFIGURE,
        );

        return $menu;
    }
}
