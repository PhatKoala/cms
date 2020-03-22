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

        $terms = [
            'Gaming' => [
                'Action', 'Adventure', 'Role-plyaing', 'Simulator', 'Strategy', 'Puzzle', 'FPS'
            ],
            'Programming' => [
                'Web' => [
                    'HTML', 'CSS', 'PHP',
                ],
                'Database' => [
                    'MySQL', 'PostgreSQL', 'MongoDB',
                ],
            ],
            'DIY' => [
                'Painting', 'Gardening',
            ],
            'News' => [
                'World', 'Local',
            ]
        ];

        foreach ($terms as $key => $val) {
            $parent = $this->addTerm($manager, $category, $key, null);
            $this->addTerms($manager, $category, $val, $parent);
        }

        $tag = $this->getReference('Taxonomy::tag');
        foreach (['HTML', 'CSS', 'PHP'] as $name) {
            $taxonomy = new Term($tag, $name);
            $taxonomy->setDescription(sprintf('My my description for my %s Tag', $name));
            $manager->persist($taxonomy);
        }

        $manager->flush();
    }

    public function addTerms($manager, $category, $terms, $parent)
    {
        foreach ($terms as $key => $val) {
            if (is_array($val)) {
                $parent = $this->addTerm($manager, $category, $key, $parent);
                $this->addTerms($manager, $category, $val, $parent);
            }
            else {
                $this->addTerm($manager, $category, $val, $parent);
            }
        }
    }

    public function addTerm($manager, $category, $name, $parent)
    {
        $term = new Term($category, $name);
        $term->setDescription(sprintf('My my description for my %s Category', $name));
        $term->setParent($parent);
        $manager->persist($term);
        return $term;
    }
}
