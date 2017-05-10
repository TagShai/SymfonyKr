<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Student
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StudentRepository")
 */
class Customer
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
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="customers")
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
     * @ORM\OneToMany(targetEntity="Work", mappedBy="customer")
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
     * @return Customer
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
     * @return Customer
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
     * Set address
     *
     * @param string $address
     *
     * @return Customer
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set account
     *
     * @param \AppBundle\Entity\User $account
     *
     * @return Customer
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

    /*
     * Set work
     *
     * @param \AppBundle\Entity\Work $work
     *
     * @return Customer
     */
/*    public function setWork(\AppBundle\Entity\Work $work = null)
    {
        $this->work = $work;

        return $this;
    }*/

    /*
     * Get work
     *
     * @return \AppBundle\Entity\Work
     */
/*    public function getWork()
    {
        return $this->work;
    }*/

    /**
     * Set fname
     *
     * @param string $fname
     *
     * @return Customer
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
     * @return Customer
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
     * @return Customer
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
     * @return Customer
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
