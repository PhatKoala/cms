<?php

declare(strict_types=1);

namespace PhatKoala\UserBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use PhatKoala\UserBundle\Entity\Demographic;
use PhatKoala\UserBundle\Entity\Taxonomy;

class DemographicFixture extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            DemographicTypeFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $membership = $this->getReference('DemographicType::membership');
        foreach (['Free Membership', 'Member', 'Premium Member'] as $title) {
            $demographic = new Demographic();
            $demographic->setType($membership);
            $demographic->setStatus('publish');
            $demographic->setTitle($title);
            $demographic->setContent(sprintf('This is the %s description.', $title));
            $manager->persist($demographic);
        }

        $company = $this->getReference('DemographicType::company');
        foreach (['Google', 'Microsoft', 'Apple', 'McDonalds'] as $title) {
            $demographic = new Demographic();
            $demographic->setType($company);
            $demographic->setStatus('publish');
            $demographic->setTitle($title);
            $demographic->setContent(sprintf('This is the %s description.', $title));
            $manager->persist($demographic);
        }

        $manager->flush();
    }
}
