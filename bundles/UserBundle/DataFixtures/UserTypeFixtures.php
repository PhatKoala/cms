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
        $admin = new UserType('admin', 'Admin', 'Admins');
        $admin->setIcon('fa fa-user-tie');
        $manager->persist($admin);
        $this->setReference('UserType::admin', $admin);

        $member = new UserType('member', 'Member', 'Members');
        $member->setIcon('fa fa-user');
        $member->getDemographics()->add($this->getReference('Demographic::company'));
        $manager->persist($member);
        $this->setReference('UserType::member', $member);

        $manager->flush();
    }
}
