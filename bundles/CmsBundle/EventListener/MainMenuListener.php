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
                ->addChild($postType->getPlural(), ['route' => 'post_list', 'routeParameters' => ['type' => $postType]])
                ->setExtra('icon', sprintf('fa fa-%s', $postType->getIcon()));

            $root
                ->addChild(sprintf('All %s', $postType->getPlural()), ['route' => 'post_list', 'routeParameters' => ['type' => $postType]])
                ->setExtra('icon', sprintf('fa fa-%s', $postType->getIcon()));

            $root
                ->addChild(sprintf('New %s', $postType->getName()), ['route' => 'post_create', 'routeParameters' => ['type' => $postType]])
                ->setExtra('icon', sprintf('fa fa-%s', $postType->getIcon()));

            foreach ($postType->getTaxonomies() as $taxonomy) {
                $root
                    ->addChild($taxonomy->getPlural(), ['route' => 'taxonomy_list', 'routeParameters' => ['type' => $taxonomy]])
                    ->setExtra('icon', sprintf('fa fa-%s', $taxonomy->getIcon()));
            }
        }
    }
}
