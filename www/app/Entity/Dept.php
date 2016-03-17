<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entity\Dept
 *
 * @Entity()
 * @Table(name="`dept`", indexes={@Index()})
 */
class Dept extends \Entity_Base
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id_dept;
    
    /**
     * @Column(type="integer")
     */
    protected $id_student;
    
    /**
     * @Column(type="integer")
     */
    protected $id_group_has_subject;
    
    /**
     * @Column(type="string", length=64, nullable=true)
     */
    protected $value_credit;

    /**
     * @Column(type="string", length=64, nullable=true)
     */
    protected $value_exam;    
    
    
    /**
     * @ManyToOne(targetEntity="Student", inversedBy="depts")
     * @JoinColumn(name="id_student", referencedColumnName="id_student")
     */
    protected $student;
    
    /**
     * @ManyToOne(targetEntity="GroupHasSubject", inversedBy="depts")
     * @JoinColumn(name="id_group_has_subject", referencedColumnName="id_group_has_subject")
     */
    protected $group_has_subject;
    
    

    public function __construct()
    {
        
    }

    /**
     * Set the value of id_dept.
     *
     * @param integer $id_dept
     * @return \Entity\GroupHasSubject
     */
    public function setIdDept(\Entity\Group $idDept)
    {
        
        $this->id_dept = $idDept;

        return $this;
    }

    /**
     * Set the value of id_dept.
     *
     * @return integer
     */
    public function getIdDept()
    {
        return $this->id_dept;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return \Entity\GroupHasSubject
     */
    public function setValueCredit($value)
    {
        $this->value_credit = $value;

        return $this;
    }

    
    /**
     * Set the value of name.
     *
     * @return string
     */
    public function getValueCredit()
    {
        return $this->value_credit;
    }
    
    
    
    /**
     * Set the value of name.
     *
     * @param string $name
     * @return \Entity\GroupHasSubject
     */
    public function setValueExam($value)
    {
        $this->value_exam = $value;

        return $this;
    }

    
    /**
     * Set the value of name.
     *
     * @return string
     */
    public function getValueExam()
    {
        return $this->value_exam;
    }
    
    
    
    /**
     * Add Subject entity 
     *
     * @param \Entity\Subject $subject
     * @return \Entity\GroupHasSubject
     */
    public function setGroupHasSubject(GroupHasSubject $subject)
    {
        
        $this->group_has_subject = $subject;

        return $this;
    }

    /**
     * Get Subject entity collection.
     *
     * @return \Entity\Subject
     */
    public function getGroupHasSubject()
    {
        return $this->group_has_subject;
    }
    
    /**
     * Add Subject entity 
     *
     * @param \Entity\Subject $subject
     * @return \Entity\Student
     */
    public function setStudent(Student $student)
    {
        $this->student = $student;
        return $this;
    }

    /**
     * Get Subject entity collection.
     *
     * @return \Entity\Student
     */
    public function getStudent()
    {
        return $this->student;
    }
    

    public function __sleep()
    {
        return array('id_group_has_subject', 'type', 'id_department');
    }
    
        /**
     * 
     */
    function getValidator() {
        if ($this->validator == null) {
            $this->validator = new \FW\Validator();
            
            $this->validator->setMessages(\FW\FW::config('messages.validator'));
            $this->validator
                    ->addRuleToAll("trim",null,array('group','subject','lecturer'))
                    ->addRule("type", function($v){ return in_array($v, array('exam','credit')) ? $v : 'credit';})
                    //->addRule("group", array("self::make_instance","Entity\Group"))
                    ->addRule("subject", array("self::make_instance","Entity\Subject"))
                    ->addRule("lecturer", array("self::make_instance","Entity\Lecturer"))        
            ;
            
            
        }
        return $this->validator;
    }
    
}