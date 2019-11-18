<?php


namespace Anaxago\CoreBundle\Services;

use Anaxago\CoreBundle\Entity\InvestmentProjectSimulation;

/**
 * User this service to manage the interest rate calculation.
 *
 * Class InterestRateCalculationService
 */
class InterestRateCalculationService
{
    /**
     * Calculation the minimum interest rate annual for a InvestmentProjectSimulation.
     *
     * @param array $data
     *
     * @return int
     */
    public function minimumInterestRateAnnual(array $data)
    {
        $result = 1;

        return $result;
    }
}