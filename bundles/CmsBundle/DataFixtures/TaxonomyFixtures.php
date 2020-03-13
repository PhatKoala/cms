<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use PhatKoala\CmsBundle\Entity\Taxonomy;

class TaxonomyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category = new Taxonomy('category', 'Category', 'Categories');
        $category->setIcon('fa fa-folder-open');
        $category->setHierarchical(false);
        $category->setUi(true);
        $manager->persist($category);
        $this->setReference('Taxonomy::category', $category);

        $tag = new Taxonomy('tag', 'Tag', 'Tags');
        $tag->setIcon('fa fa-tags');
        $tag->setHierarchical(false);
        $tag->setUi(true);
        $manager->persist($tag);
        $this->setReference('Taxonomy::tag', $tag);

        $manager->flush();
    }
}
