<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entity\Faculty
 *
 * @Entity()
 * @Table(name="faculty", indexes={@Index(name="fk_faculty_dean1_idx", columns={"id_dean"})})
 */
class Faculty extends \Entity_Base
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id_faculty;

    /**
     * @Column(type="string", length=45, nullable=true)
     */
    protected $name;

    /**
     * @OneToMany(targetEntity="Department", mappedBy="faculty")
     * @JoinColumn(name="id_faculty", referencedColumnName="id_faculty")
     */
    protected $departments;
    
    /**
     * @Column(type="integer")
     */
    protected $id_dean;
    
    /**
     * @ManyToOne(targetEntity="Dean", inversedBy="faculties")
     * @JoinColumn(name="id_dean", referencedColumnName="id_dean")
     */
    protected $dean;

    public function __construct()
    {
        $this->departments = new ArrayCollection();
    }

    /**
     * Set the value of id_faculty.
     *
     * @param integer $id_faculty
     * @return \Entity\Faculty
     */
    public function setIdFaculty($id_faculty)
    {
        $this->id_faculty = $id_faculty;

        return $this;
    }

    /**
     * Get the value of id_faculty.
     *
     * @return integer
     */
    public function getIdFaculty()
    {
        return $this->id_faculty;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return \Entity\Faculty
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add Department entity to collection (one to many).
     *
     * @param \Entity\Department $department
     * @return \Entity\Faculty
     */
    public function addDepartment(Department $department)
    {
        $this->departments[] = $department;

        return $this;
    }

    /**
     * Get Department entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepartments()
    {
        return $this->departments;
    }

    
    public function setIdDean($id_dean)
    {
        $this->id_dean = $id_dean;

        return $this;
    }

    /**
     * Get the value of id_dean.
     *
     * @return integer
     */
    public function getIdDean()
    {
        return $this->id_dean;
    }
    
    /**
     * Set Dean entity (many to one).
     *
     * @param \Entity\Dean $dean
     * @return \Entity\Faculty
     */
    public function setDean(Dean $dean = null)
    {
        $this->dean = $dean;

        return $this;
    }

    /**
     * Get Dean entity (many to one).
     *
     * @return \Entity\Dean
     */
    public function getDean()
    {
        return $this->dean;
    }

    public function __sleep()
    {
        return array('id_faculty', 'name', 'id_dean');
    }
    
    function getValidator() {
        if ($this->validator == null) {
            $this->validator = new \FW\Validator();
            $this->validator->setMessages(\FW\FW::config('messages.validator'));
            $this->validator
                    ->addRuleToAll("self::make_trim",null,array('departments', 'dean'))
                    ->addRule("name", array("self::check_len",1,42))
                    ->addRule("faculty", array("self::make_instance","Entity\Faculty"))
            ;
            
            
        }
        return $this->validator;
    }
    
    
}