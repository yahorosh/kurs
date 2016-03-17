<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entity\Dean
 *
 * @Entity()
 * @Table(name="dean")
 */
class Dean extends \Entity_Base
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id_dean;

    /**
     * @Column(type="string", length=45, nullable=true)
     */
    protected $name;

    /**
     * @OneToMany(targetEntity="Faculty", mappedBy="dean")
     * @JoinColumn(name="id_dean", referencedColumnName="id_dean")
     */
    protected $faculties;

    public function __construct()
    {
        $this->faculties = new ArrayCollection();
    }

    /**
     * Set the value of id_dean.
     *
     * @param integer $id_dean
     * @return \Entity\Dean
     */
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
     * Set the value of name.
     *
     * @param string $name
     * @return \Entity\Dean
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
     * Add Faculty entity to collection (one to many).
     *
     * @param \Entity\Faculty $faculty
     * @return \Entity\Dean
     */
    public function addFaculty(Faculty $faculty)
    {
        $this->faculties[] = $faculty;

        return $this;
    }

    /**
     * Get Faculty entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFaculties()
    {
        return $this->faculties;
    }

    public function __sleep()
    {
        return array('id_dean', 'name');
    }
    
    function getValidator() {
        if ($this->validator == null) {
            $this->validator = new \FW\Validator();
            $this->validator->setMessages(\FW\FW::config('messages.validator'));
            $this->validator
                    ->addRuleToAll("self::make_trim",null,array('faculties'))
                    ->addRule("name", array("self::check_len",1,42))
            ;
            
            
        }
        return $this->validator;
    }
    
}