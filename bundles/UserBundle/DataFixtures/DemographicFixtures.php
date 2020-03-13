<?php

declare(strict_types=1);

namespace PhatKoala\UserBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use PhatKoala\UserBundle\Entity\Demographic;
use PhatKoala\UserBundle\Entity\TaxonomyType;

class DemographicFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $membership = new Demographic('membership', 'Membership', 'Memberships');
        $membership->setIcon('fa fa-id-card');
        $membership->setHierarchical(false);
        $membership->setUi(true);
//        $membership->setDemographics(['company']);
        $manager->persist($membership);
        $this->setReference('Demographic::membership', $membership);

        $company = new Demographic('company', 'Company', 'Companies');
        $company->setIcon('fa fa-briefcase');
        $company->setHierarchical(false);
        $company->setUi(true);
        $manager->persist($company);
        $this->setReference('Demographic::company', $company);

        $manager->flush();
    }
}
