<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entity\Lecturer
 *
 * @Entity()
 * @Table(name="lecturer")
 */
class Lecturer  extends \Entity_Base
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id_lecturer;

    /**
     * @Column(type="string", length=45, nullable=true)
     */
    protected $name;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    protected $passport;

    /**
     * @Column(type="string", length=45, nullable=true)
     */
    protected $foto;

    /**
     * @Column(type="string", length=45, nullable=true)
     */
    protected $id_department;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    protected $address;

    /**
     * @Column(type="string", length=45, nullable=true)
     */
    protected $phone;

    /**
     * @Column(type="string", length=45, nullable=true)
     */
    protected $degree;

    /**
     * @Column(type="integer", nullable=true)
     */
    protected $id_chief;

    /**
     * @Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    protected $salary;

    /**
     * @ManyToMany(targetEntity="Subject", inversedBy="lecturers")
     * @JoinTable(name="lecturer_has_subject",
     *     joinColumns={@JoinColumn(name="id_lecturer", referencedColumnName="id_lecturer")},
     *     inverseJoinColumns={@JoinColumn(name="id_subject", referencedColumnName="id_subject")}
     * )
     */
    protected $subjects;

    /**
     * @OneToMany(targetEntity="GroupHasSubject", mappedBy="lecturer")
     * @JoinColumn(name="id_lecturer", referencedColumnName="id_lecturer")
     */
    protected $group_has_subjects;
    
    public function __construct()
    {
        $this->subjects = new ArrayCollection();
    }

    /**
     * Set the value of id_lecturer.
     *
     * @param integer $id_lecturer
     * @return \Entity\Lecturer
     */
    public function setIdLecturer($id_lecturer)
    {
        $this->id_lecturer = $id_lecturer;

        return $this;
    }

    /**
     * Get the value of id_lecturer.
     *
     * @return integer
     */
    public function getIdLecturer()
    {
        return $this->id_lecturer;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return \Entity\Lecturer
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
     * @return \Entity\Lecturer
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
     * Set the value of foto.
     *
     * @param string $foto
     * @return \Entity\Lecturer
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get the value of foto.
     *
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set the value of id_department.
     *
     * @param string $id_department
     * @return \Entity\Lecturer
     */
    public function setIdDepartment($id_department)
    {
        $this->id_department = $id_department;

        return $this;
    }

    /**
     * Get the value of id_department.
     *
     * @return string
     */
    public function getIdDepartment()
    {
        return $this->id_department;
    }

    /**
     * Set the value of address.
     *
     * @param string $address
     * @return \Entity\Lecturer
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of address.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of phone.
     *
     * @param string $phone
     * @return \Entity\Lecturer
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of phone.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of degree.
     *
     * @param string $degree
     * @return \Entity\Lecturer
     */
    public function setDegree($degree)
    {
        $this->degree = $degree;

        return $this;
    }

    /**
     * Get the value of degree.
     *
     * @return string
     */
    public function getDegree()
    {
        return $this->degree;
    }

    /**
     * Set the value of id_chief.
     *
     * @param integer $id_chief
     * @return \Entity\Lecturer
     */
    public function setIdShieff($id_chief)
    {
        $this->id_chief = $id_chief;

        return $this;
    }

    /**
     * Get the value of id_chief.
     *
     * @return integer
     */
    public function getIdShieff()
    {
        return $this->id_chief;
    }

    /**
     * Set the value of salary.
     *
     * @param float $salary
     * @return \Entity\Lecturer
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * Get the value of salary.
     *
     * @return float
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * Add Subject entity to collection.
     *
     * @param \Entity\Subject $subject
     * @return \Entity\Lecturer
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

    public function __sleep()
    {
        return array('id_lecturer', 'name', 'passport', 'foto', 'id_department', 'address', 'phone', 'degree', 'id_chief', 'salary');
    }
    
        
    /**
     * 
     */
    function getValidator() {
        if ($this->validator == null) {
            
            $subjectsValidator = new \FW\Validator();
            $subjectsValidator->addRuleToAll(array('self::make_instance','Entity\Subject'));
            
            $this->validator = new \FW\Validator();
            $this->validator->setMessages(\FW\FW::config('messages.validator'));
            $this->validator
                    ->addRuleToAll("self::make_trim",null,array('subjects'))
                    ->addRule("name", array("self::check_len",4,122))
                    ->addRuleCritical("subjects", function($v){ return is_array($v) || is_null($v); })
                    ->addRule("subjects", $subjectsValidator)
            ;
            
            
        }
        return $this->validator;
    }
    
    
}