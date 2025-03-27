<?php

namespace App\DataFixtures;

use App\Entity\Starship;
use App\Entity\StarshipStatusEnum;
use App\Factory\StarshipFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        StarshipFactory::createMany(25);

    }
}
