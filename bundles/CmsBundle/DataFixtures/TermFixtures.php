<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use PhatKoala\CmsBundle\Entity\Term;

class TermFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            TaxonomyFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $category = $this->getReference('Taxonomy::category');
        foreach (['Tutorial', 'Review', 'News'] as $title) {
            $taxonomy = new Term($category);
            $taxonomy->setStatus('publish');
            $taxonomy->setTitle($title);
            $taxonomy->setContent(sprintf('My my description for my %s Category', $title));
            $manager->persist($taxonomy);
        }

        $tag = $this->getReference('Taxonomy::tag');
        foreach (['HTML', 'CSS', 'PHP'] as $title) {
            $taxonomy = new Term($tag);
            $taxonomy->setStatus('publish');
            $taxonomy->setTitle($title);
            $taxonomy->setContent(sprintf('My my description for my %s Tag', $title));
            $manager->persist($taxonomy);
        }

        $manager->flush();
    }
}
