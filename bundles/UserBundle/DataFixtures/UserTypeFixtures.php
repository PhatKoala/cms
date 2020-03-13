<?php

declare(strict_types=1);

namespace PhatKoala\UserBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use PhatKoala\CmsBundle\Entity\PostType;
use PhatKoala\UserBundle\Entity\UserType;

class UserTypeFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            DemographicFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $post = new UserType('admin', 'Admin', 'Admins');
        $post->setIcon('fa fa-newspaper');
        $post->setHierarchical(false);
        $post->setUi(true);
        $post->getTaxonomies()->add($this->getReference('Taxonomy::category'));
        $post->getTaxonomies()->add($this->getReference('Taxonomy::tag'));
        $manager->persist($post);
        $this->setReference('PostType::blog', $post);

        $page = new PostType('page', 'Page', 'Pages');
        $page->setIcon('fa fa-file');
        $page->setHierarchical(false);
        $page->setUi(true);
        $manager->persist($page);
        $this->setReference('PostType::page', $page);

        $manager->flush();
    }
}
