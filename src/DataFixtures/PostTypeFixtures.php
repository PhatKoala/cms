<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\PostType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PostTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $post = new PostType();
        $post->setType('blog');
        $post->setTitle('Post');
        $post->setPlural('Posts');
        $post->setIcon('fa fa-newspaper');
        $post->setHierarchical(false);
        $post->setUi(true);
        $post->setTaxonomies(['category', 'tag']);
        $manager->persist($post);

        $post = new PostType();
        $post->setType('page');
        $post->setTitle('Page');
        $post->setPlural('Pages');
        $post->setIcon('fa fa-file');
        $post->setHierarchical(false);
        $post->setUi(true);
        $manager->persist($post);

        $manager->flush();
    }
}
