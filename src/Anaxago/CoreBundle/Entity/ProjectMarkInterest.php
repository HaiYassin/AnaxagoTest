<?php

namespace Anaxago\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectMarkInterest
 *
 * @ORM\Table(name="project_mark_interest")
 * @ORM\Entity(repositoryClass="Anaxago\CoreBundle\Repository\ProjectMarkInterestRepository")
 */
class ProjectMarkInterest implements \JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="Anaxago\CoreBundle\Entity\User", mappedBy="interestedMark", cascade={"persist", "remove"})
     */
    private $interestedUsers;

    /**
     * @ORM\ManyToMany(targetEntity="Anaxago\CoreBundle\Entity\Project", mappedBy="interestedMark", cascade={"persist", "remove"})
     */
    private $projects;

    /**
     * @var int
     *
     * @ORM\Column(name="valueInvest", type="integer")
     */
    private $valueInvest;

    /**
     * ProjectMarkInterest constructor.
     */
    public function __construct()
    {
        $this->interestedUsers = new ArrayCollection();
        $this->projects = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add an User to the Project ArrayCollection
     *
     * @param User $user
     *
     * @return ProjectMarkInterest
     */
    public function addUser(User $user)
    {
        if (!$this->interestedUsers->contains($user)) {
            $this->interestedUsers->add($user);
            $user->addProjectMarkInterest($this);
        }

        return $this;
    }

    /**
     * Remove an User from the Project ArrayCollection
     *
     * @param User $user
     *
     * @return ProjectMarkInterest
     */
    public function removeUser(User $user)
    {
        if ($this->interestedUsers->contains($user)) {
            $this->interestedUsers->removeElement($user);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getInterestedUsers()
    {
        return $this->interestedUsers->toArray();
    }

    /**
     * Add a Project to the Project ArrayCollection
     *
     * @param Project $project
     *
     * @return ProjectMarkInterest
     */
    public function addProject(Project $project)
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->addProjectMarkInterest($this);
        }

        return $this;
    }

    /**
     * Remove a Project from the Project ArrayCollection
     *
     * @param Project $project
     *
     * @return ProjectMarkInterest
     */
    public function removeProject(Project $project)
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getProjects()
    {
        return $this->projects->toArray();
    }

    /**
     * Get valueInvest.
     *
     * @return int
     */
    public function getValueInvest()
    {
        return $this->valueInvest;
    }

    /**
     * @param int $valueInvest
     *
     * @return ProjectMarkInterest
     */
    public function setValueInvest(int $valueInvest)
    {
        $this->valueInvest = $valueInvest;

        return $this;
    }

    public function toArray()
    {
        return array(
            'id' => $this->getId(),
            'valueInvest' => $this->getValueInvest(),
            'users' => $this->getInterestedUsers(),
            'projects' => $this->getProjects()
        );
    }

    /**
     * jsonSerialize for ProjectMarkInterest Entity.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
