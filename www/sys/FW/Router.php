<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace FW;
/**
 * Description of Router
 *
 * @author horoshev
 */
class Router {
    //put your code here
    protected $routes;
    static protected $instance = null;
    
    protected function __construct() {
        
    }
    /**
     * 
     * @return \FW\Router
     */
    public static function getInstance(){
        if (self::$instance==null){
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    public function addRoute($name, $method, $regexp, \Closure $parser, $builder = null){
        if (!$this){
            return self::getInstance()->addRoute($name, $method, $regexp, $parser, $builder);
        }
        $method = is_array($method) or $method==null ? $method : array($method);
        
        $this->routes[$name] = array($method, $regexp, $parser, $builder);
        return $this;
    }
    /**
     * 
     * @param string $method
     * @param string $uri
     * @param array $params
     * @return \FW\Request
     */
    public function run($method,$uri,$params=array()){
        foreach($this->routes as $k=>$v){
            if($v[0] == null or (is_array($v[0]) and in_array($method, $v[0]))){
                $matches = array();
                if(preg_match($v[1], $uri,$matches)){
                    if ($v[2] instanceof \Closure){
                        $result = $v[2]($matches,$method,$uri,$params);
                        if($result==false){
                            continue;
                        } else {
                            return $result;
                        }
                        
                    }
                }
            }
        }
    }
    
    public function url($name, $request, $base = true){
        return ($base ? FW::baseUrl() : "").$this->routes[$name][3]((object)$request);
    }
    

    
    
    
    
}

?>
