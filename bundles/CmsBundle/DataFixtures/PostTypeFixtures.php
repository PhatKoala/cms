<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use PhatKoala\CmsBundle\Entity\PostType;

class PostTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $blog = new PostType();
        $blog->setType('blog');
        $blog->setName('Post');
        $blog->setPlural('Posts');
        $blog->setIcon('fa fa-newspaper');
        $blog->setHierarchical(false);
        $blog->setUi(true);
        $blog->setTaxonomies(['category', 'tag']);
        $manager->persist($blog);
        $this->setReference('PostType::blog', $blog);

        $page = new PostType();
        $page->setType('page');
        $page->setName('Page');
        $page->setPlural('Pages');
        $page->setIcon('fa fa-file');
        $page->setHierarchical(false);
        $page->setUi(true);
        $manager->persist($page);
        $this->setReference('PostType::page', $page);

        $manager->flush();
    }
}
