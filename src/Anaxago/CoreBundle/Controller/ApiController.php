<?php


namespace Anaxago\CoreBundle\Controller;


use Anaxago\CoreBundle\Entity\InvestmentProjectSimulation;
use Anaxago\CoreBundle\Entity\Project;
use Anaxago\CoreBundle\Services\InterestRateCalculationService;
use Anaxago\CoreBundle\Services\InvestmentProjectSimulationService;
use Anaxago\CoreBundle\Services\ProjectMarkInterestService;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiController
 *
 * @Route("/api", name="api_")
 */
class ApiController extends Controller
{
    /**
     * @Route(
     *          "/projects",
     *          name="projects_list",
     *          methods={"GET"}
     *     )
     *
     * @param EntityManagerInterface $entityManager
     *
     * @return JsonResponse
     */
    public function projectsListAction(EntityManagerInterface $entityManager)
    {
        $projects = $entityManager->getRepository(Project::class)->findAll();

        return $this->json(
            array(
                'data' => $projects,
                'status' => Response::HTTP_OK
            )
        );
    }

    /**
     * @Route(
     *      "/project-interest-mark",
     *      name="project_interest_mark",
     *      methods={"POST"}
     * )
     *
     * @Security("is_granted('ROLE_USER')")
     *
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function getProjectMarkInterest(Request $request)
    {
        $data['user'] = $this->getUser();
        $data = json_decode($request->getContent(), true);

        $projectMarkInterest = $this->get(ProjectMarkInterestService::class)->createProjectMarkInterest($data);

        $this->getDoctrine()->getManager()->persist($projectMarkInterest);
        $this->getDoctrine()->getManager()->flush();

        return $this->json(
            array(
                "data" => "You request is saved.",
                "status" => Response::HTTP_OK
            )
        );
    }

    /**
     * @Route(
     *          "/investment-project-simulation/min-annual-interest-rate",
     *          name="investment_project_simulation_min_annual_interest_rate",
     *          methods={"POST"}
     *      )
     *
     * @Security("is_granted('ROLE_USER')")
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getInvestmentProjectSimulationMinimumAnnualInterestRate(Request $request)
    {
        if (null == $this->getUser()) {
            return $this->json(
                array(
                    'data' => 'bad user',
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR
                )
            );
        }

        $data['user'] = $this->getUser();
        $data = json_decode($request->getContent(), true);

        //TODO move in the service that will check if value is empty
        if (empty($data['duration']) || empty($data['initialCapital']) || empty($data['desiredCapital'])){
            return $this->json(
                array(
                    'data' => 'Something is missing. Check your value',
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR
                )
            );
        }

        /** @var InvestmentProjectSimulationService $investmentProjectSimulation */
        $investmentProjectSimulation = $this->get(InvestmentProjectSimulationService::class)->createInvestmentProjectSimulation($data);

        $this->getDoctrine()->getManager()->persist($investmentProjectSimulation);
        $this->getDoctrine()->getManager()->flush();
        
        /** @var InterestRateCalculationService $result */
        $result = $this->get(InterestRateCalculationService::class)->minimumInterestRateAnnual($data);

        return $this->json(
            array(
                'data' => $result,
                'status' => Response::HTTP_OK
            )
        );
    }
}