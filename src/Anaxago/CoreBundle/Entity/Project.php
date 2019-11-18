<?php

namespace Anaxago\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="Anaxago\CoreBundle\Repository\ProjectRepository")
 */
class Project implements \JsonSerializable
{
    CONST FUNDED_PROJECT = 'financé';
    CONST NOT_FUNDED_PROJECT = 'non-financé';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string")
     */
    private $state = Project::NOT_FUNDED_PROJECT;

    /**
     * @ORM\ManyToOne(targetEntity="Anaxago\CoreBundle\Entity\User", inversedBy="projects")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     */
    private $user;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Project
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Project
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get State
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set State
     *
     * @param string $state
     *
     * @return Project
     */
    public function setState(string $state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get User attached to this project
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set User
     *
     * @param User $user
     *
     * @return Project
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get an array with object property.
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            'id' => $this->getId(),
            'slug' => $this->getTitle(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'state' => $this->getState(),
            'user' => $this->getUser()
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
