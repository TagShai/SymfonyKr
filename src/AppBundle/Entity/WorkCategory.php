<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * WorkCategory
 *
 * @ORM\Table(name="work_category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WorkCategoryRepository")
 */
class WorkCategory
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * @ORM\OneToMany(targetEntity="Work", mappedBy="category")
     */
    private $works;




    public function __construct()
    {

        $this->works = new ArrayCollection();
    }
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
     * Set name
     *
     * @param string $name
     *
     * @return WorkCategory
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
        return $this->name;
    }

    /**
     * Add teacher
     *
     * @param \AppBundle\Entity\Work $teacher
     *
     * @return WorkCategory
     */
    public function addTeacher(\AppBundle\Entity\Work $teacher)
    {
        $this->teachers[] = $teacher;

        return $this;
    }

    /**
     * Remove teacher
     *
     * @param \AppBundle\Entity\Work $teacher
     */
    public function removeTeacher(\AppBundle\Entity\Work $teacher)
    {
        $this->teachers->removeElement($teacher);
    }

    /**
     * Get teachers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeachers()
    {
        return $this->teachers;
    }

    /**
     * Add work
     *
     * @param \AppBundle\Entity\Work $work
     *
     * @return WorkCategory
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
