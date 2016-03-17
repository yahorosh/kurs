<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entity\Department
 *
 * @Entity()
 * @Table(name="department", indexes={@Index(name="fk_department_faculty1_idx", columns={"id_faculty"})})
 */
class Department extends \Entity_Base
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id_department;

    /**
     * @Column(type="string", length=45, nullable=true)
     */
    protected $name;

    /**
     * @OneToMany(targetEntity="Group", mappedBy="department")
     * @JoinColumn(name="id_department", referencedColumnName="id_department")
     */
    protected $groups;

    /**
     * @ManyToOne(targetEntity="Faculty", inversedBy="departments")
     * @JoinColumn(name="id_faculty", referencedColumnName="id_faculty")
     */
    protected $faculty;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
    }

    /**
     * Set the value of id_department.
     *
     * @param integer $id_department
     * @return \Entity\Department
     */
    public function setIdDepartment($id_department)
    {
        $this->id_department = $id_department;

        return $this;
    }

    /**
     * Get the value of id_department.
     *
     * @return integer
     */
    public function getIdDepartment()
    {
        return $this->id_department;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return \Entity\Department
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
     * Add Group entity to collection (one to many).
     *
     * @param \Entity\Group $group
     * @return \Entity\Department
     */
    public function addGroup(Group $group)
    {
        $this->groups[] = $group;

        return $this;
    }

    /**
     * Get Group entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Set Faculty entity (many to one).
     *
     * @param \Entity\Faculty $faculty
     * @return \Entity\Department
     */
    public function setFaculty(Faculty $faculty = null)
    {
        $this->faculty = $faculty;

        return $this;
    }

    /**
     * Get Faculty entity (many to one).
     *
     * @return \Entity\Faculty
     */
    public function getFaculty()
    {
        return $this->faculty;
    }

    public function __sleep()
    {
        return array('id_department', 'name', 'id_faculty');
    }
    
    
    function getValidator() {
        if ($this->validator == null) {
            $this->validator = new \FW\Validator();
            $this->validator->setMessages(\FW\FW::config('messages.validator'));
            $this->validator
                    ->addRuleToAll("self::make_trim",null,array('faculty', 'groups'))
                    ->addRule("name", array("self::check_len",1,42))
                    //->addRule("faculty", array("self::make_instance","Entity\Faculty"))
            ;
            
            
        }
        return $this->validator;
    }
    
}