<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entity\Subject
 *
 * @Entity()
 * @Table(name="subject")
 */
class Subject extends \Entity_Base
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id_subject;

    /**
     * @Column(type="string", length=45, nullable=true)
     */
    protected $name;

    /**
     * @ManyToMany(targetEntity="Group", mappedBy="subjects")
     */
    protected $groups;

    /**
     * @ManyToMany(targetEntity="Lecturer", mappedBy="subjects")
     */
    protected $lecturers;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
        $this->lecturers = new ArrayCollection();
        $this->students = new ArrayCollection();
    }

    /**
     * Set the value of id_subject.
     *
     * @param integer $id_subject
     * @return \Entity\Subject
     */
    public function setIdSubject($id_subject)
    {
        $this->id_subject = $id_subject;

        return $this;
    }

    /**
     * Get the value of id_subject.
     *
     * @return integer
     */
    public function getIdSubject()
    {
        return $this->id_subject;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return \Entity\Subject
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
     * Add Group entity to collection.
     *
     * @param \Entity\Group $group
     * @return \Entity\Subject
     */
    public function addGroup(Group $group)
    {
        $this->groups[] = $group;

        return $this;
    }

    /**
     * Get Group entity collection.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Add Lecturer entity to collection.
     *
     * @param \Entity\Lecturer $lecturer
     * @return \Entity\Subject
     */
    public function addLecturer(Lecturer $lecturer)
    {
        $this->lecturers[] = $lecturer;

        return $this;
    }

    /**
     * Get Lecturer entity collection.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLecturers()
    {
        return $this->lecturers;
    }

    /**
     * Add Student entity to collection.
     *
     * @param \Entity\Student $student
     * @return \Entity\Subject
     */
    public function addStudent(Student $student)
    {
        $this->students[] = $student;

        return $this;
    }

    /**
     * Get Student entity collection.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStudents()
    {
        return $this->students;
    }

    public function __sleep()
    {
        return array('id_subject', 'name');
    }
        /**
     * 
     */
    function getValidator() {
        if ($this->validator == null) {
            $this->validator = new \FW\Validator();
            $this->validator->setMessages(\FW\FW::config('messages.validator'));
            $this->validator
                    ->addRuleToAll("self::make_trim")
                    ->addRule("name", array("self::check_len",4,122))                        
            ;
            
            
        }
        return $this->validator;
    }
    
}