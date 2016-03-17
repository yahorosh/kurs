<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace FW;
/**
 * Description of Validator
 *
 * @author horoshev
 */
class Validator {
    //put your code here
    
    
    const UNSET_UDVALIDATED = 1;
    const KEEP_UDVALIDATED = 0;
    
    protected $rules=array();
    protected $errors=array();
    protected $data = array();
    protected $_data = array();
    protected $messages = array();
    protected $defaultMessage = 'The field "%1$s" has errors.';
    protected $unsetMode=self::KEEP_UDVALIDATED;
    protected $criticals = array();
    
    /**
     * 
     * @param array $data
     */
    function __construct($data = array()) {
        $this->setData($data);
    }
    /**
     * Delete all 
     * @param type $mode
     * @return \FW\Validator
     */
    function unsetMode($mode=self::KEEP_UDVALIDATED){
        $this->unsetMode = $mode;
        return $this;
    }
    /**
     * 
     * @param array $data
     */
    function setData($data){
        $this->_data = (array)$data;
    }


    /**
     * 
     * @param array $messages
     */
    function setMessages($messages = array()){
        $this->messages=$messages;
    }


    /**
     * 
     * @param \Closure|string $rule
     * @param array $messages
     * @return \Validator
     */
    public function addRuleToAll($rule, $message=null, $exclude=array()){
        $this->addRule(array('exclude'=>$exclude), $rule, $message);
        return $this;
    }
    /**
     * 
     * @param string|array $field
     * @param \Closure|string|FW\Validator $rule
     * @param string $message
     * @return \Validator
     */
    public function addRule($field, $rule, $message=null){
        $field = is_array($field) ? $field : array($field);
        $this->rules[] = array("fields"=>$field,"function" => $rule, "message" => $message, 'is_critical' => false);
        return $this;
    }
    
    /**
     * 
     * @param string|array $field
     * @param \Closure|string|FW\Validator $rule
     * @param string $message
     * @return \Validator
     */
    public function addRuleCritical($field, $rule, $message=null){
        $field = is_array($field) ? $field : array($field);
        $this->rules[] = array("fields"=>$field,"function" => $rule, "message" => $message, 'is_critical' => true);
        return $this;
    }
    
    /**
     * 
     * @return boolean
     */
    public function validate(){
        $this->errors=array();
        $this->criticals = array();
        $this->data =  $this->_data;
        $valid = true;
        foreach($this->rules as $rule){
            
            $ruleFunction = $rule['function'];
            $fieldNames = $rule['fields'];
            $ruleMessage = $rule['message'];
            $isCritical = $rule['is_critical'];
            
            
            if(key_exists('exclude', $fieldNames) and is_array($fieldNames['exclude'])){
                $fieldNames = array_diff(array_keys($this->data), $fieldNames['exclude']);
            }
            
            foreach($fieldNames as $k=>$fieldName){
                
                
                if($ruleFunction == "#clear_criticals") unset($this->criticals[$fieldName]);
                
                if(key_exists($fieldName, $this->criticals)) continue;
                
                if($ruleFunction instanceof Validator){
                    $ruleFunction->setData($this->data[$fieldName]);
                    $result = $ruleFunction->validate();
                    $this->data[$fieldName]=$ruleFunction->getData();
                    if(count($ruleFunction->getErrors()) > 0){
                        $this->errors[$fieldName][] = $ruleFunction->getErrors();
                    }
                } 
                
                if(is_object($this->data[$fieldName]) or is_array($this->data[$fieldName])){
                    //continue;
                }
                
                
                if(is_callable($ruleFunction) or $ruleFunction instanceof \Closure){
                    $p = array($this->data[$fieldName]);
                    $f = is_string($ruleFunction) ? preg_replace('~^self::~is', get_class($this)."::", $ruleFunction) : $ruleFunction;
                    $result = call_user_func_array($f,$p);
                }
                if(is_array($ruleFunction) && (is_callable($ruleFunction[0]) or $ruleFunction[0] instanceof \Closure)){
                    $p = $ruleFunction;
                    $p[0] = $this->data[$fieldName];
                    $f = preg_replace('~^self::~is', get_class($this)."::", $ruleFunction[0]);
                    $result = call_user_func_array($f,$p);
                }
                
                
                

                if($result === false){
                    $valid = false;
                    if($isCritical) {
                        $this->criticals[$fieldName] = $fieldName;
                    }
                    if($ruleMessage!==false){
                        $message = ($ruleMessage=== null and is_string($f) and key_exists($f, $this->messages)) ? $this->messages[$f] :  $ruleMessage;
                        $message = $message ? $message : $this->defaultMessage;
                        $p = array_merge( array($message), array($fieldName), $p);
                        $this->errors[$fieldName][] = call_user_func_array("sprintf", $p);
                        $message = null;
                    }
                } else if($result!==true AND $result!==null ){
                    $this->data[$fieldName]=$result;
                }
            }
        }
        
        return $valid;
    }
    /**
     * 
     * @return array
     */
    public function getData(){
        return $this->data;
    }
    /**
     * 
     * @return array
     */
    public function getErrors(){
        return $this->errors;
    }
    
    /**
     * 
     * @param string $v
     * @param int $length
     * @return string
     */
    static function make_cut($v,$length = 255){
        return substr($v, 0, $length);
    }
    static function make_int($v){
        return (int)$v;
    }
    
    static function check_len($v,$min=0, $max=255){
        return (mb_strlen($v) > $min) && (mb_strlen($v)<$max);
    }
    
    static function check_digit($v){
        return preg_match('~^[0-9]+$~is', $v);
    }
    
    static function make_trim($v){
        return trim($v);
    }
    
    static function make_instance($data, $entityClass){ 
        
        
        if(is_a($data,$entityClass)) return true;
        
        if($data==null or $data==0){
            return true;
        }
        
        if(is_string($data) or is_int($data)){
            $el=\FW\FW::getEm()->getRepository($entityClass)->find($data);
            if($el) return $el;
        }
        

        if(is_array($data)){
            /*
            $uow = \FW\FW::getEm()->getUnitOfWork();
            return $uow->createEntity($entityClass, $data);
             * 
             */
            $em =\FW\FW::getEM();
            $meta = $em->getClassMetadata($entityClass);
            $pk = $meta->getIdentifierFieldNames();
            $key = array();
            foreach($pk as $vk){
                if($data[$vk]) $key[$vk] = $data[$vk];
            }
            if(count($key)==1) $key = array_shift($key);
            if(count($key)==0) $key = null;
            if($key){
                $en =  $em->getRepository($entityClass)->find($key);
            } else {
                $en = new $entityClass;
                $en->from_array($data);
                
            }
            if($en) return $en;
        }
        
        return false;
     }
    
    
    
}
