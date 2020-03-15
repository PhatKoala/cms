<?php

declare(strict_types=1);

namespace PhatKoala\DashboardBundle\EventListener;

use PhatKoala\CoreBundle\Event\MainMenuEvent;

class MainMenuListener
{
    public function onMenuConfigure(MainMenuEvent $event)
    {
        $menu = $event->getMenu();

        $menu->addChild('Matches', ['route' => 'dashboard']);
        $menu->addChild('Participants', ['route' => 'dashboard']);
    }
}
