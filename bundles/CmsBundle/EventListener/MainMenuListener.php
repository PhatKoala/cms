<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\EventListener;

use PhatKoala\CmsBundle\Repository\PostTypeRepository;
use PhatKoala\CoreBundle\Event\MainMenuEvent;

class MainMenuListener
{
    private PostTypeRepository $postType;

    public function __construct(PostTypeRepository $postType)
    {
        $this->postType = $postType;
    }

    public function onMenuConfigure(MainMenuEvent $event)
    {
        $menu = $event->getMenu();

        foreach ($this->postType->findAll() as $postType) {
            $root = $menu
                ->addChild($postType->getPlural(), ['route' => 'dashboard'])
                ->setExtra('icon', sprintf('fa fa-%s', $postType->getIcon()));

            foreach ($postType->getTaxonomies() as $taxonomy) {
                $root
                    ->addChild($taxonomy->getPlural(), ['route' => 'dashboard'])
                    ->setExtra('icon', sprintf('fa fa-%s', $taxonomy->getIcon()));
            }
        }
    }
}
