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
        $post = new PostType();
        $post->setType('blog');
        $post->setName('Post');
        $post->setPlural('Posts');
        $post->setIcon('fa fa-newspaper');
        $post->setHierarchical(false);
        $post->setUi(true);
        $post->setTaxonomies(['category', 'tag']);
        $manager->persist($post);

        $post = new PostType();
        $post->setType('page');
        $post->setName('Page');
        $post->setPlural('Pages');
        $post->setIcon('fa fa-file');
        $post->setHierarchical(false);
        $post->setUi(true);
        $manager->persist($post);

        $manager->flush();
    }
}
