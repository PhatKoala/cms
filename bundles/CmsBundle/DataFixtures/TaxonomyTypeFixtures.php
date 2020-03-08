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
        $category = new TaxonomyType();
        $category->setType('category');
        $category->setName('Category');
        $category->setPlural('Categories');
        $category->setIcon('fa fa-folder-open');
        $category->setHierarchical(false);
        $category->setUi(true);
        $manager->persist($category);
        $this->setReference('TaxonomyType::category', $category);

        $tag = new TaxonomyType();
        $tag->setType('tag');
        $tag->setName('Tag');
        $tag->setPlural('Tags');
        $tag->setIcon('fa fa-tags');
        $tag->setHierarchical(false);
        $tag->setUi(true);
        $manager->persist($tag);
        $this->setReference('TaxonomyType::tag', $tag);

        $manager->flush();
    }
}
