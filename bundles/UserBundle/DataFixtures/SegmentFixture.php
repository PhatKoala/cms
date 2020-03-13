<?php

declare(strict_types=1);

namespace PhatKoala\UserBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use PhatKoala\UserBundle\Entity\Segment;
use PhatKoala\UserBundle\Entity\Taxonomy;

class SegmentFixture extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            DemographicFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $membership = $this->getReference('Demographic::membership');
        foreach (['Free Membership', 'Member', 'Premium Member'] as $name) {
            $demographic = new Segment($membership, $name);
            $demographic->setDescription(sprintf('This is the %s description.', $name));
            $manager->persist($demographic);
        }

        $company = $this->getReference('Demographic::company');
        foreach (['Google', 'Microsoft', 'Apple', 'McDonalds'] as $name) {
            $demographic = new Segment($company, $name);
            $demographic->setDescription(sprintf('This is the %s description.', $name));
            $manager->persist($demographic);
        }

        $manager->flush();
    }
}
