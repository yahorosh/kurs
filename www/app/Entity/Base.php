<?php

    /*
     * To change this template, choose Tools | Templates
     * and open the template in the editor.
     */

    use FW\FW,
        FW\Validator;

    /**
     * Description of Base
     *
     * @author horoshev
     */

    /**
     * @MappedSuperclass
     * @HasLifecycleCallbacks 
     */
    abstract class Entity_Base{

        //put your code here
        protected $assocs_flags = array();
        protected $validator;

        //protected $em;

        function __construct() {
            //$this->em = FW::getEM();
        }
        /**
         * 
         * @return array
         */
        function to_array(){
            $assocs = func_get_args();
            $r = $this->_to_array($assocs);
            return $r;
        }

        protected function _to_array($assocs) {

            $em = FW::getEM();
            $d = $em->getClassMetadata(get_class($this));


            $fields = $d->getFieldNames();
            $ass = $d->getAssociationNames();

            $vals = array();


            foreach ($fields as $k => $v) {
                $vals[$v] = $this->{$v};
            }

            foreach($assocs as $k=>$v){
                    $way = explode(".", $v);
                    $first = array_shift($way);
                    $way = implode(".", $way);
                    if( ! in_array($first, $ass)) continue;

                    if ($this->{$first} instanceof Entity_Base ) {
                        $this->{$first}->id();
                        $vals[$first] = $this->{$first}->_to_array(array($way));
                    }

                    if (($this->{$first} instanceof Doctrine\ORM\PersistentCollection)) {
                        $vals[$first]=array();
                        foreach ($this->{$first} as $vv) {
                            $vv->id();
                            $vals[$first][] = $vv->_to_array(array($way));
                        }
                    }

                    if ($this->{$first} instanceof \Doctrine\Common\Collections\ArrayCollection) {
                        $vals[$first]=array();
                        foreach ($this->{$first} as $vv) {
                            $vals[$first][] = $vv->_to_array(array($way));
                        }
                    }
                    if ($this->{$first} == null){
                        $vals[$first]=null;
                    }


            }

            return $vals;
        }

        public function id(){
            $em = FW::getEM();
            $meta = $em->getClassMetadata(get_class($this));
            $pk = $meta->getIdentifierFieldNames();
            $key = array();
            foreach($pk as $v){
                if($this->{$v}) $key[$v] = $this->{$v};
            }
            if(count($key)==1) $key = array_shift($key);
            if(count($key)==0) $key = null;

            return $key;
        }

        function from_array(array $data) {

            $this->getValidator()->setData($data);

            if( ! $this->getValidator()->validate()){
                return false;
            }

            $data = $this->getValidator()->getData();

            $em = FW::getEM();
            $d = $em->getClassMetadata(get_class($this));


            $fields = $d->getFieldNames();
            $ass = $d->getAssociationMappings();

            foreach ($fields as $k => $v) {
                    if (key_exists($v, $data)) {
                    $this->{$v} = $data[$v];
                }
            }
           
            foreach ($ass as $k=>$v){
                
                if (key_exists($k, $data)) {
                    if(
                            (is_array($this->{$k}) or $this->{$k} instanceof ArrayAccess)
                            and (is_array($data[$k]) or $data[$k] instanceof ArrayAccess)
                    ){
                            
                        foreach($data[$k] as $kk=>$vv){
                           
                            $this->{$k}[] = $data[$k][$kk];
                        }
                    } else {
                        $this->{$k} = $data[$k];
                    }
                }
                
                
                /*
                if(is_a($this->{$k}, Collection) && is_array($data[$k])){

                } else if( key_exists($k,$data)){
                    $em = FW::getEM();
                    $meta = $em->getClassMetadata($v['targetEntity']);
                    $pk = $meta->getIdentifierFieldNames();
                    $key = array();
                    foreach($pk as $vk){
                        if($data[$k][$vk]) $key[$vk] = $data[$k][$vk];
                    }
                    if(count($key)==1) $key = array_shift($key);
                    if(count($key)==0) $key = null;
                    $en =  $em->getRepository($v['targetEntity'])->find($key);
                    if($en) $this->{$k} = $en;
                }*/
            }
            return true;


        }

        /**
         * @PrePersist @PreUpdate
         */
        function validate() {

        }

        /**
         * @return FW\Validator Description
         */
        function getValidator() {
            if ($this->validator == null) {
                $this->validator = new Validator();
            }
            return $this->validator;
        }




    }
