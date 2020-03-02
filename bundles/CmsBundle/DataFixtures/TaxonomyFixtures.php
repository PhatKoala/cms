<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\DataFixtures;

use PhatKoala\CmsBundle\Entity\Taxonomy;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TaxonomyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach (['Tutorial', 'Review', 'News'] as $category) {
            $taxonomy = new Taxonomy();
            $taxonomy->setType('category');
            $taxonomy->setStatus('publish');
            $taxonomy->setTitle($category);
            $taxonomy->setContent(sprintf('My my description for my %s Category', $category));
            $manager->persist($taxonomy);
        }

        foreach (['HTML', 'CSS', 'PHP'] as $tag) {
            $taxonomy = new Taxonomy();
            $taxonomy->setType('tag');
            $taxonomy->setStatus('publish');
            $taxonomy->setTitle($tag);
            $taxonomy->setContent(sprintf('My my description for my %s Tag', $tag));
            $manager->persist($taxonomy);
        }

        $manager->flush();
    }
}
