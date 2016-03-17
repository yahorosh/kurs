<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entity\Group
 *
 * @Entity()
 * @Table(name="`group`", indexes={@Index(name="fk_group_department1_idx", columns={"id_department"})})
 */
class Group extends \Entity_Base
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id_group;

    /**
     * @Column(type="string", length=64, nullable=true)
     */
    protected $name;

    /**
     * @OneToMany(targetEntity="Student", mappedBy="group")
     * @JoinColumn(name="id_group", referencedColumnName="id_group")
     */
    protected $students;

    /**
     * @ManyToOne(targetEntity="Department", inversedBy="groups")
     * @JoinColumn(name="id_department", referencedColumnName="id_department")
     */
    protected $department;
    
    /**
     * 
     * @OneToMany(targetEntity="GroupHasSubject", mappedBy="group",cascade={"persist"})
     * @JoinColumn(name="id_group", referencedColumnName="id_group")
     */
    protected $group_has_subjects;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->group_has_subjects = new ArrayCollection();
    }

    /**
     * Set the value of id_group.
     *
     * @param integer $id_group
     * @return \Entity\Group
     */
    public function setIdGroup($id_group)
    {
        $this->id_group = $id_group;

        return $this;
    }

    /**
     * Get the value of id_group.
     *
     * @return integer
     */
    public function getIdGroup()
    {
        return $this->id_group;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return \Entity\Group
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
     * Add Student entity to collection (one to many).
     *
     * @param \Entity\Student $student
     * @return \Entity\Group
     */
    public function addStudent(Student $student)
    {
        $this->students[] = $student;

        return $this;
    }

    /**
     * Get Student entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * Set Department entity (many to one).
     *
     * @param \Entity\Department $department
     * @return \Entity\Group
     */
    public function setDepartment(Department $department = null)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get Department entity (many to one).
     *
     * @return \Entity\Department
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Add Subject entity to collection.
     *
     * @param \Entity\GroupHasSubject $subject
     * @return \Entity\Group
     */
    public function addGroupHasSubject(GroupHasSubject $groupHasSubject)
    {
        $this->group_has_subjects[] = $groupHasSubject;

        return $this;
    }

    /**
     * Get Subject entity collection.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroupHasSubjects()
    {
        return $this->group_has_subjects;
    }

    public function __sleep()
    {
        return array('id_group', 'name', 'id_department');
    }
    
        /**
     * 
     */
    function getValidator() {
        if ($this->validator == null) {
            $this->validator = new \FW\Validator();
            
            $subjectsValidator = new \FW\Validator();
            $subjectsValidator->addRuleToAll(array('self::make_instance','Entity\GroupHasSubject'));
            
            $this->validator->setMessages(\FW\FW::config('messages.validator'));
            $this->validator
                    ->addRuleToAll("self::make_trim",null,array('department','group_has_subjects','students'))
                    ->addRule("name", array("self::check_len",1,12))
                    ->addRule("department", array("self::make_instance","Entity\Department"))
                    ->addRuleCritical("group_has_subjects", function($v){ return is_array($v) || is_null($v); })
                    ->addRule("group_has_subjects", $subjectsValidator)
                    //->addRule("group_has_subjects", function($v){ echo "\n".get_class($v)."\n";})
                            
            ;
            
            
        }
        return $this->validator;
    }
    
}