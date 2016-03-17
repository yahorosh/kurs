<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entity\GroupHasSubject
 *
 * @Entity()
 * @Table(name="group_has_subject", indexes={@Index()})
 */
class GroupHasSubject extends \Entity_Base
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id_group_has_subject;
    
    
    
    /**
     * @Column(type="string", length=64, nullable=true)
     */
    protected $type;
    /*
    / **
     * @Column(type="integer")
     * /
    protected $id_group;
    */
    
    /**
     * @Column(type="integer")
     */
    protected $id_subject;
    
    /**
     * @Column(type="integer")
     */
    protected $id_lecturer;
    
    
    /**
     * @ManyToOne(targetEntity="Group", inversedBy="group_has_subjects")
     * @JoinColumn(name="id_group", referencedColumnName="id_group")
     */
    protected $group;
    
    /**
     * @ManyToOne(targetEntity="Lecturer", inversedBy="lecturer")
     * @JoinColumn(name="id_lecturer", referencedColumnName="id_lecturer")
     */
    protected $lecturer;
    

    /**
     * @ManyToOne(targetEntity="Subject", inversedBy="subject")
     * @JoinColumn(name="id_subject", referencedColumnName="id_subject")
     */
    protected $subject;

    /**
     * @OneToMany(targetEntity="Dept", mappedBy="group_has_subject")
     * @JoinColumn(name="id_group_has_subject", referencedColumnName="id_group_has_subject")
     */
    protected $depts;
    
    
    
    
    public function __construct()
    {
        
    }

    /**
     * Set the value of id_group.
     *
     * @param integer $id_group
     * @return \Entity\GroupHasSubject
     */
    public function setGroup(\Entity\Group $group)
    {
        
        $this->group = $group;

        return $this;
    }

    /**
     * Get the value of id_group.
     *
     * @return \Entity\Group
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return \Entity\GroupHasSubject
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of name.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
   
    
        /**
     * Set the value of name.
     *
     * @param string $name
     * @return \Entity\GroupHasSubject
     */
    public function setIdGroup($idGroup)
    {
        $this->id_group = $idGroup;

        return $this;
    }

    /**
     * Get the value of name.
     *
     * @return string
     */
    public function getIdGroup()
    {
        return $this->id_group;
    }

    /**
     * Add Subject entity 
     *
     * @param \Entity\Subject $subject
     * @return \Entity\GroupHasSubject
     */
    public function setSubject(Subject $subject)
    {
        
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get Subject entity collection.
     *
     * @return \Entity\Subject
     */
    public function getSubject()
    {
        return $this->subject;
    }
    
    /**
     * Add Subject entity 
     *
     * @param \Entity\Subject $subject
     * @return \Entity\GroupHasSubject
     */
    public function setLecturer(Lecturer $lecturer)
    {
        $this->lecturer = $lecturer;
        return $this;
    }

    /**
     * Get Subject entity collection.
     *
     * @return \Entity\Subject
     */
    public function getLecturer()
    {
        return $this->lecturer;
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