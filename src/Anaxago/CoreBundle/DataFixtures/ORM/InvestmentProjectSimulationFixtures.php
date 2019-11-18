<?php

namespace Anaxago\CoreBundle\DataFixtures\ORM;

use Anaxago\CoreBundle\Entity\InvestmentProjectSimulation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class InvestmentProjectSimulationFixtures
 */
class InvestmentProjectSimulationFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = UserFixtures::getUserInvestor();

        foreach ($this->getInvestmentProjectsSimulation() as $investmentProjectSimulation) {
            $investmentProjectSimulationToPersist = (new InvestmentProjectSimulation())
                ->setDuration($investmentProjectSimulation['duration'])
                ->setInitialCapital($investmentProjectSimulation['initialCapital'])
                ->setDesiredCapital($investmentProjectSimulation['desiredCapital'])
                ->setUser($user);

            $manager->persist($investmentProjectSimulationToPersist);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getInvestmentProjectsSimulation(): array 
    {
        return array(
            array(
                'duration' => 12,
                'initialCapital' => 1000,
                'desiredCapital' => 12000
            ),
            array(
                'duration' => 1,
                'initialCapital' => 1000,
                'desiredCapital' => 5000
            ),
            array(
                'duration' => 6,
                'initialCapital' => 50,
                'desiredCapital' => 200
            )
        );
    }
}