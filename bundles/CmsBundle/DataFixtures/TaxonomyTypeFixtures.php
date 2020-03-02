<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\DataFixtures;

use PhatKoala\CmsBundle\Entity\TaxonomyType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TaxonomyTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $taxonomy = new TaxonomyType();
        $taxonomy->setType('category');
        $taxonomy->setTitle('Category');
        $taxonomy->setPlural('Categories');
        $taxonomy->setIcon('fa fa-folder-open');
        $taxonomy->setHierarchical(false);
        $taxonomy->setUi(true);
        $manager->persist($taxonomy);

        $taxonomy = new TaxonomyType();
        $taxonomy->setType('tag');
        $taxonomy->setTitle('Tag');
        $taxonomy->setPlural('Tags');
        $taxonomy->setIcon('fa fa-tags');
        $taxonomy->setHierarchical(false);
        $taxonomy->setUi(true);
        $manager->persist($taxonomy);

        $manager->flush();
    }
}
