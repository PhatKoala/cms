<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\DataFixtures;

use PhatKoala\CmsBundle\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 3; $i++) {
            $post = new Post();
            $post->setType('blog');
            $post->setStatus('publish');
            $post->setTitle(sprintf('My Blog Post Title %d', $i));
            $post->setContent(sprintf('This is the blog post content for blog post %d', $i));
            $manager->persist($post);
        }

        for ($i = 1; $i <= 3; $i++) {
            $post = new Post();
            $post->setType('page');
            $post->setStatus('publish');
            $post->setTitle(sprintf('My Page Title %d', $i));
            $post->setContent(sprintf('This is the page content for page %d', $i));
            $manager->persist($post);
        }

        $manager->flush();
    }
}
