<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace FW;
/**
 * Description of Request
 *
 * @author horoshev
 */
class Request {
    
    public $directory;
    public $controller;
    public $action;
    public $params;
    
    public function execute(){
            $controller = Controller::create($this);
            $controller->execute();
    }
    
    static function create($controller="Index", $action="Index",$params =array()){
        $request = new self();
        $request->controller = $controller;
        $request->action = $action;
        $request->params = $params;
        return $request;
    }
    
    public function params($key, $default=null){
        if(key_exists($key, $this->params)){
            return $this->params[$key];
        }
        return $default;
    }
    //put your code here
}

?>
