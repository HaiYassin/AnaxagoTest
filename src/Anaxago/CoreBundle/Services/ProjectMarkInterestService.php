<?php


namespace Anaxago\CoreBundle\Services;


use Anaxago\CoreBundle\Entity\ProjectMarkInterest;

class ProjectMarkInterestService
{
    /**
     * Create ProjectMarkInterest
     *
     * @param array $data
     *
     * @return ProjectMarkInterest
     */
    public function createProjectMarkInterest(array $data)
    {
        $projectMarkInterest = new ProjectMarkInterest();
        $projectMarkInterest
            ->addUser($data['user'])
            ->addProject($data['project'])
            ->setValueInvest($data['valueInvest']);

        return $projectMarkInterest;
    }
}