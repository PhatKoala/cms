<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use PhatKoala\CmsBundle\Entity\Taxonomy;

class TaxonomyFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            TaxonomyTypeFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $category = $this->getReference('TaxonomyType::category');
        foreach (['Tutorial', 'Review', 'News'] as $title) {
            $taxonomy = new Taxonomy();
            $taxonomy->setType($category);
            $taxonomy->setStatus('publish');
            $taxonomy->setTitle($title);
            $taxonomy->setContent(sprintf('My my description for my %s Category', $title));
            $manager->persist($taxonomy);
        }

        $tag = $this->getReference('TaxonomyType::tag');
        foreach (['HTML', 'CSS', 'PHP'] as $title) {
            $taxonomy = new Taxonomy();
            $taxonomy->setType($tag);
            $taxonomy->setStatus('publish');
            $taxonomy->setTitle($title);
            $taxonomy->setContent(sprintf('My my description for my %s Tag', $title));
            $manager->persist($taxonomy);
        }

        $manager->flush();
    }
}
