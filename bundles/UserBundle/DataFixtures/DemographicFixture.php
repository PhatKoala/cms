<?php

namespace PhatKoala\UserBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use PhatKoala\UserBundle\Entity\Demographic;
use PhatKoala\UserBundle\Entity\Taxonomy;

class DemographicFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach (['Free Membership', 'Member', 'Premium Member'] as $membership) {
            $demographic = new Demographic();
            $demographic->setType('membership');
            $demographic->setStatus('publish');
            $demographic->setTitle($membership);
            $demographic->setContent(sprintf('This is the %s description.', $membership));
            $manager->persist($demographic);
        }

        foreach (['Google', 'Microsoft', 'Apple', 'McDonalds'] as $company) {
            $demographic = new Demographic();
            $demographic->setType('company');
            $demographic->setStatus('publish');
            $demographic->setTitle($company);
            $demographic->setContent(sprintf('This is the %s description.', $company));
            $manager->persist($demographic);
        }

        $manager->flush();
    }
}
