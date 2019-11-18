<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 12/07/18
 * Time: 16:48
 */

namespace Anaxago\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $lastName;

    /**
     * @var array
     * @ORM\Column(type="array")
     */
    private $roles = ['ROLE_USER'];

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string
     */
    private $plainPassword;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $salt;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Anaxago\CoreBundle\Entity\Project", mappedBy="user", indexBy="id")
     */
    private $projects;

    /**
     * @ORM\OneToMany(targetEntity="Anaxago\CoreBundle\Entity\InvestmentProjectSimulation", mappedBy="user")
     */
    private $investmentProjectsSimulation;

    /**
     * @ORM\ManyToMany(targetEntity="Anaxago\CoreBundle\Entity\ProjectMarkInterest", inversedBy="projects", orphanRemoval=true)
     */
    private $interestedMark;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
        $this->investmentProjectsSimulation = new ArrayCollection();
        $this->interestedMark = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName(string $firstName): User
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->firstName.' '.$this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName(string $lastName): User
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     *
     * @return string[] The user roles
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param array $roles
     *
     * @return User
     */
    public function setRoles(array $roles): User
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @param string $role
     *
     * @return User
     */
    public function addRoles(string $role): User
    {
        if (!\in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     *
     * @return User
     */
    public function setPlainPassword(string $plainPassword): User
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * @param string $salt
     *
     * @return User
     */
    public function setSalt(string $salt): User
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return User
     */
    public function setEmail(string $email): User
    {
        // email will be our username
        $this->username = $email;
        $this->email = $email;

        return $this;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
    }

    /**
     * Add a project to the Project ArrayCollection
     *
     * @param Project $project
     *
     * @return User
     */
    public function addProject(Project $project)
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->setUser($this);
        }

        return $this;
    }

    /**
     * Remove a project from the Project ArrayCollection
     *
     * @param Project $project
     *
     * @return User
     */
    public function removeProject(Project $project)
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
        }

        return $this;
    }

    /**
     * Add a investmentProjectSimulation to the InvestmentProjectSimulation ArrayCollection
     *
     * @param InvestmentProjectSimulation $investmentProjectSimulation
     * @return User
     */
    public function addInvestmentProjectSimulation(InvestmentProjectSimulation $investmentProjectSimulation)
    {
        if (!$this->investmentProjectsSimulation->contains($investmentProjectSimulation)) {
            $this->investmentProjectsSimulation->add($investmentProjectSimulation);
            $investmentProjectSimulation->setUser($this);
        }

        return $this;
    }

    /**
     * Remove a investmentProjectSimulation from the InvestmentProjectSimulation ArrayCollection
     *
     * @param InvestmentProjectSimulation $investmentProjectSimulation
     * @return User
     */
    public function removeInvestmentProjectSimulation(InvestmentProjectSimulation $investmentProjectSimulation)
    {
        if ($this->investmentProjectsSimulation->contains($investmentProjectSimulation)) {
            $this->investmentProjectsSimulation->removeElement($investmentProjectSimulation);
        }

        return $this;
    }


    /**
     * @param ProjectMarkInterest $projectMarkInterest
     *
     * @return User
     */
    public function addProjectMarkInterest(ProjectMarkInterest $projectMarkInterest)
    {
        if (!$this->interestedMark->contains($projectMarkInterest)) {
            $this->interestedMark->add($projectMarkInterest);
        }

        return $this;
    }
}
