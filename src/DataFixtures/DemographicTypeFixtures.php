<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\DemographicType;
use App\Entity\TaxonomyType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DemographicTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $demographic = new DemographicType();
        $demographic->setType('membership');
        $demographic->setTitle('Membership');
        $demographic->setPlural('Memberships');
        $demographic->setIcon('fa fa-id-card');
        $demographic->setHierarchical(false);
        $demographic->setUi(true);
        $demographic->setDemographics(['company']);
        $manager->persist($demographic);

        $demographic = new DemographicType();
        $demographic->setType('company');
        $demographic->setTitle('Company');
        $demographic->setPlural('Companies');
        $demographic->setIcon('fa fa-briefcase');
        $demographic->setHierarchical(false);
        $demographic->setUi(true);
        $manager->persist($demographic);

        $manager->flush();
    }
}