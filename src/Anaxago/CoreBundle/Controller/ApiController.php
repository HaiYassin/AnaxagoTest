<?php


namespace Anaxago\CoreBundle\Controller;


use Anaxago\CoreBundle\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     *      "/projects",
     *      name="projects_list",
     *      methods={"GET"}
     *     )
     *
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
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
}