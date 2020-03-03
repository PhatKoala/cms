<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use PhatKoala\CmsBundle\Entity\TaxonomyType;

class TaxonomyTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $taxonomy = new TaxonomyType();
        $taxonomy->setType('category');
        $taxonomy->setName('Category');
        $taxonomy->setPlural('Categories');
        $taxonomy->setIcon('fa fa-folder-open');
        $taxonomy->setHierarchical(false);
        $taxonomy->setUi(true);
        $manager->persist($taxonomy);

        $taxonomy = new TaxonomyType();
        $taxonomy->setType('tag');
        $taxonomy->setName('Tag');
        $taxonomy->setPlural('Tags');
        $taxonomy->setIcon('fa fa-tags');
        $taxonomy->setHierarchical(false);
        $taxonomy->setUi(true);
        $manager->persist($taxonomy);

        $manager->flush();
    }
}
