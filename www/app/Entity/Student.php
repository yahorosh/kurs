<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entity\Student
 *
 * @Entity()
 * @Table(name="student", indexes={@Index(name="fk_student_group_idx", columns={"id_group"})})
 */
class Student extends \Entity_Base
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id_student;

    /**
     * @Column(type="string", length=45, nullable=true)
     */
    protected $name;

    /**
     * @Column(type="string", length=145, nullable=true)
     */
    protected $passport;

    /**
     * @Column(type="integer", nullable=true)
     */
    protected $rec_date;

    /**
     * @Column(type="string", length=45, nullable=true)
     */
    protected $order_no;

    /**
     * @ManyToOne(targetEntity="Group", inversedBy="students")
     * @JoinColumn(name="id_group", referencedColumnName="id_group")
     */
    protected $group;

    
    /**
     * @OneToMany(targetEntity="Dept", mappedBy="student")
     * @JoinColumn(name="id_student", referencedColumnName="id_student")
     */
    protected $depts;
    
    
    public function __construct()
    {
        $this->subjects = new ArrayCollection();
    }

    /**
     * Set the value of id_student.
     *
     * @param integer $id_student
     * @return \Entity\Student
     */
    public function setIdStudent($id_student)
    {
        $this->id_student = $id_student;

        return $this;
    }

    /**
     * Get the value of id_student.
     *
     * @return integer
     */
    public function getIdStudent()
    {
        return $this->id_student;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return \Entity\Student
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
     * Set the value of passport.
     *
     * @param string $passport
     * @return \Entity\Student
     */
    public function setPassport($passport)
    {
        $this->passport = $passport;

        return $this;
    }

    /**
     * Get the value of passport.
     *
     * @return string
     */
    public function getPassport()
    {
        return $this->passport;
    }

    /**
     * Set the value of rec_date.
     *
     * @param integer $rec_date
     * @return \Entity\Student
     */
    public function setRecDate($rec_date)
    {
        $this->rec_date = $rec_date;

        return $this;
    }

    /**
     * Get the value of rec_date.
     *
     * @return integer
     */
    public function getRecDate()
    {
        return $this->rec_date;
    }

    /**
     * Set the value of order_no.
     *
     * @param string $order_no
     * @return \Entity\Student
     */
    public function setOrderNo($order_no)
    {
        $this->order_no = $order_no;

        return $this;
    }

    /**
     * Get the value of order_no.
     *
     * @return string
     */
    public function getOrderNo()
    {
        return $this->order_no;
    }

    /**
     * Set the value of id_department.
     *
     * @param integer $id_department
     * @return \Entity\Student
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
     * Set Group entity (many to one).
     *
     * @param \Entity\Group $group
     * @return \Entity\Student
     */
    public function setGroup(Group $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get Group entity (many to one).
     *
     * @return \Entity\Group
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Add Subject entity to collection.
     *
     * @param \Entity\Subject $subject
     * @return \Entity\Student
     */
    public function addSubject(Subject $subject)
    {
        $this->subjects[] = $subject;

        return $this;
    }

    /**
     * Get Subject entity collection.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubjects()
    {
        return $this->subjects;
    }

    
    
    /**
     * Add Subject entity to collection.
     *
     * @param \Entity\Dept $dept
     * @return \Entity\Student
     */
    public function addDept(Dept $dept)
    {
        $this->depts[] = $dept;
        return $this;
    }

    /**
     * Get Subject entity collection.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepts()
    {
        return $this->depts;
    }
    
    public function __sleep()
    {
        return array('id_student', 'name', 'passport', 'rec_date', 'order_no', 'id_group', 'id_department');
    }
    
    /**
     * 
     */
    function getValidator() {
        if ($this->validator == null) {
            $this->validator = new \FW\Validator();
            $this->validator->setMessages(\FW\FW::config('messages.validator'));
            $this->validator
                    ->addRuleToAll("self::make_trim",null,array('group','subjects','depts'))
                    ->addRule("name", array("self::check_len",4,12))
                    ->addRule("rec_date", "strtotime")
                    ->addRule("group", array("self::make_instance","Entity\Group"))
                    
            ;
            
            
        }
        return $this->validator;
    }
    
}