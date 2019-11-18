<?php

namespace Anaxago\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvestmentProjectSimulation
 *
 * @ORM\Table(name="investment_project_simulation")
 * @ORM\Entity(repositoryClass="Anaxago\CoreBundle\Repository\InvestmentProjectSimulationRepository")
 */
class InvestmentProjectSimulation implements \JsonSerializable
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
     * @var int
     *
     * @ORM\Column(name="duration", type="integer")
     */
    private $duration;

    /**
     * @var int
     *
     * @ORM\Column(name="initialCapital", type="integer")
     */
    private $initialCapital;

    /**
     * @var int
     *
     * @ORM\Column(name="desiredCapital", type="integer")
     */
    private $desiredCapital;

    /**
     * @ORM\ManyToOne(targetEntity="Anaxago\CoreBundle\Entity\User", inversedBy="investmentProjectsSimulation", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id" )
     */
    private $user;

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
     * Set duration.
     *
     * @param int $duration
     *
     * @return InvestmentProjectSimulation
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration.
     *
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set initialCapital.
     *
     * @param int $initialCapital
     *
     * @return InvestmentProjectSimulation
     */
    public function setInitialCapital($initialCapital)
    {
        $this->initialCapital = $initialCapital;

        return $this;
    }

    /**
     * Get initialCapital.
     *
     * @return int
     */
    public function getInitialCapital()
    {
        return $this->initialCapital;
    }

    /**
     * Set desiredCapital.
     *
     * @param int $desiredCapital
     *
     * @return InvestmentProjectSimulation
     */
    public function setDesiredCapital($desiredCapital)
    {
        $this->desiredCapital = $desiredCapital;

        return $this;
    }

    /**
     * Get desiredCapital.
     *
     * @return int
     */
    public function getDesiredCapital()
    {
        return $this->desiredCapital;
    }

    /**
     * Set user.
     *
     * @param User $user
     *
     * @return InvestmentProjectSimulation
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get an array with object properties
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            'id' => $this->getId(),
            'user' => $this->getUser(),
            'duration' => $this->getDuration(),
            'initialCapital' => $this->getInitialCapital(),
            'desiredCapital' => $this->getDesiredCapital()
        );
    }

    /**
     * jsonSerialize for Project Entity.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
