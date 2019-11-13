<?php


namespace Anaxago\CoreBundle\Controller;


use Anaxago\CoreBundle\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiController
 *
 * @Route("/api", name="api")
 */
class ApiController extends Controller
{
    /**
     * @Route(
     *      "/projects",
     *      name="api_projects_list",
     *      methods={"GET"}
     *     )
     *
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function listProjectsAction(EntityManagerInterface $entityManager)
    {
        $projects = $entityManager->getRepository(Project::class)->findAll();

        return $this->json(
            array(
                'data' => $projects,
                'status' => Response::HTTP_OK
            )
        );
    }
}