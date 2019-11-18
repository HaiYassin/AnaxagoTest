<?php


namespace Anaxago\CoreBundle\Services;

use Anaxago\CoreBundle\Entity\InvestmentProjectSimulation;

/**
 * Class InvestmentProjectSimulationService
 */
class InvestmentProjectSimulationService
{
    /**
     * Create an InvestmentProjectSimulation Entity, with data.
     *
     * @param array $data
     *
     * @return InvestmentProjectSimulation
     */
    public function createInvestmentProjectSimulation(array $data)
    {
        $investmentProjectSimulation = new InvestmentProjectSimulation();
        $investmentProjectSimulation
            ->setDuration($data['duration'])
            ->setInitialCapital($data['initialCapital'])
            ->setDesiredCapital($data['desiredCapital'])
            ->setUser($data['user']);

        return $investmentProjectSimulation;
    }
}