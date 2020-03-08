<?php

declare(strict_types=1);

namespace PhatKoala\UserBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use PhatKoala\UserBundle\Entity\DemographicType;
use PhatKoala\UserBundle\Entity\TaxonomyType;

class DemographicTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $membership = new DemographicType();
        $membership->setType('membership');
        $membership->setName('Membership');
        $membership->setPlural('Memberships');
        $membership->setIcon('fa fa-id-card');
        $membership->setHierarchical(false);
        $membership->setUi(true);
        $membership->setDemographics(['company']);
        $manager->persist($membership);
        $this->setReference('DemographicType::membership', $membership);

        $company = new DemographicType();
        $company->setType('company');
        $company->setName('Company');
        $company->setPlural('Companies');
        $company->setIcon('fa fa-briefcase');
        $company->setHierarchical(false);
        $company->setUi(true);
        $manager->persist($company);
        $this->setReference('DemographicType::company', $company);

        $manager->flush();
    }
}
