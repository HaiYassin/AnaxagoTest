<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiControllerTest
 */
class ApiControllerTest extends WebTestCase
{
    public function testGetProjectsListAction()
    {
        $client = static::createClient();

        $crawler = $client->request(
            'GET',
            $client->getContainer()->get('router')->generate('api_projects_list')
        );

        $responseContent = json_decode($client->getResponse()->getContent(), true);

        $this->assertCount(2, $responseContent);
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertArrayHasKey('data', $responseContent);
        $this->assertNotEmpty($responseContent['data']);
        $this->assertCount(3, $responseContent['data']);

        foreach ($responseContent['data'] as $project) {
            $this->assertCount(6, $project);
            $this->assertArrayHasKey('id', $project);
            $this->assertArrayHasKey('slug', $project);
            $this->assertArrayHasKey('title', $project);
            $this->assertArrayHasKey('description', $project);
            $this->assertArrayHasKey('state', $project);
            $this->assertArrayHasKey('user', $project);
        }
    }

    public function testGetInvestmentProjectSimulationMinimumAnnualInterestRate()
    {
        $client = static::createClient();

        //TODO SIMULATE AN AUTHENTIFICATION WITH ROLE_USER

        $parameters = array();

        $crawler = $client->request(
            'POST',
            $client->getContainer()->get('router')->generate('api_investment_project_simulation_min_annual_interest_rate'),
            array(
                $parameters
            )
        );

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
}
