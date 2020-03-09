<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use PhatKoala\CmsBundle\Entity\Post;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            PostTypeFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $blog = $this->getReference('PostType::blog');
        for ($i = 1; $i <= 3; $i++) {
            $post = new Post($blog);
            $post->setStatus('publish');
            $post->setTitle(sprintf('My Blog Post Title %d', $i));
            $post->setContent(sprintf('This is the blog post content for blog post %d', $i));
            $manager->persist($post);
        }

        $page = $this->getReference('PostType::page');
        for ($i = 1; $i <= 3; $i++) {
            $post = new Post($page);
            $post->setStatus('publish');
            $post->setTitle(sprintf('My Page Title %d', $i));
            $post->setContent(sprintf('This is the page content for page %d', $i));
            $manager->persist($post);
        }

        $manager->flush();
    }
}
