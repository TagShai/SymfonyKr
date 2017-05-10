<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 10.05.2017
 * Time: 3:37
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Worker
 *
 * @ORM\Table(name="worker")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WorkerRepository")
 */
class Worker
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
     * @var string
     *
     * @ORM\Column(name="fname", type="string", length=255)
     */
    private $fname;

    /**
     * @var string
     *
     * @ORM\Column(name="lname", type="string", length=255)
     */
    private $lname;

    /**
     * @var string
     *
     * @ORM\Column(name="mname", type="string", length=255)
     */
    private $mname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="workers")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id",onDelete="SET NULL")
     */
    private $account;

    private $name;
    /**
     * Get id
     *
     * @return int
     */

    /**
     * @ORM\OneToMany(targetEntity="Work", mappedBy="worker")
     */
    private $works;

    public function __construct()
    {
        $this->works = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Worker
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }


    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->lname ." ". substr($this->fname,0,1) .".". substr($this->mname,0,1).".";
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Worker
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set account
     *
     * @param \AppBundle\Entity\User $account
     *
     * @return Worker
     */
    public function setAccount(\AppBundle\Entity\User $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \AppBundle\Entity\User
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set work
     *
     * @param \AppBundle\Entity\Work $work
     *
     * @return Worker
     */
    public function setWork(\AppBundle\Entity\Work $work = null)
    {
        $this->work = $work;

        return $this;
    }

    /**
     * Get work
     *
     * @return \AppBundle\Entity\Work
     */
    public function getWork()
    {
        return $this->work;
    }

    /**
     * Set fname
     *
     * @param string $fname
     *
     * @return Worker
     */
    public function setFname($fname)
    {
        $this->fname = $fname;

        return $this;
    }

    /**
     * Get fname
     *
     * @return string
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * Set lname
     *
     * @param string $lname
     *
     * @return Worker
     */
    public function setLname($lname)
    {
        $this->lname = $lname;

        return $this;
    }

    /**
     * Get lname
     *
     * @return string
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * Set mname
     *
     * @param string $mname
     *
     * @return Worker
     */
    public function setMname($mname)
    {
        $this->mname = $mname;

        return $this;
    }

    /**
     * Get mname
     *
     * @return string
     */
    public function getMname()
    {
        return $this->mname;
    }

    /**
     * Add work
     *
     * @param \AppBundle\Entity\Work $work
     *
     * @return Worker
     */
    public function addWork(\AppBundle\Entity\Work $work)
    {
        $this->works[] = $work;

        return $this;
    }

    /**
     * Remove work
     *
     * @param \AppBundle\Entity\Work $work
     */
    public function removeWork(\AppBundle\Entity\Work $work)
    {
        $this->works->removeElement($work);
    }

    /**
     * Get works
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWorks()
    {
        return $this->works;
    }
}