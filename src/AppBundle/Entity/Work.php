<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Work
 *
 * @ORM\Table(name="work")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WorkRepository")
 */
class Work
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
     * @ORM\Column(name="theme", type="string", length=255)
     */
    private $theme;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text")
     */
    private $notes;

    /**
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="works")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="Worker", inversedBy="works")
     * @ORM\JoinColumn(name="$worker_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $worker;

    /**
     * @ORM\ManyToOne(targetEntity="WorkCategory", inversedBy="works")
     * @ORM\JoinColumn(name="workcategory_id", referencedColumnName="id",onDelete="SET NULL")
     */
    private $category;

    /**
     * @var bool
     * @ORM\Column(name="isTest" ,type="boolean")
     */
    private $isDone;

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
     * Set theme
     *
     * @param string $theme
     *
     * @return Work
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set notes
     *
     * @param string $notes
     *
     * @return Work
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set customer
     *
     * @param \AppBundle\Entity\Customer $customer
     *
     * @return Work
     */
    public function setCustomer(\AppBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \AppBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set worker
     *
     * @param \AppBundle\Entity\Worker $worker
     *
     * @return Work
     */
    public function setWorker(\AppBundle\Entity\Worker $worker = null)
    {
        $this->worker = $worker;

        return $this;
    }

    /**
     * Get worker
     *
     * @return \AppBundle\Entity\Worker
     */
    public function getWorker()
    {
        return $this->worker;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\WorkCategory $category
     *
     * @return Work
     */
    public function setCategory(\AppBundle\Entity\WorkCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\WorkCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set isDone
     *
     * @param boolean $isDone
     *
     * @return Work
     */
    public function setIsDone($isDone)
    {
        $this->isDone = $isDone;

        return $this;
    }

    /**
     * Get isDone
     *
     * @return boolean
     */
    public function getIsDone()
    {
        return $this->isDone;
    }
}
