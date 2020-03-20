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
        foreach (['Tutorial', 'Review', 'News', 'Gaming', 'DIY', 'Cooking', 'Holiday', 'Computer', 'Shopping', 'Hardware', 'Software', 'Sports', 'Exercise', 'Painting', 'Drinking'] as $name) {
            $taxonomy = new Term($category, $name);
            $taxonomy->setDescription(sprintf('My my description for my %s Category', $name));
            $manager->persist($taxonomy);
        }

        $tag = $this->getReference('Taxonomy::tag');
        foreach (['HTML', 'CSS', 'PHP'] as $name) {
            $taxonomy = new Term($tag, $name);
            $taxonomy->setDescription(sprintf('My my description for my %s Tag', $name));
            $manager->persist($taxonomy);
        }

        $manager->flush();
    }
}
