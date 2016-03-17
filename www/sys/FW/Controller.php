<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace FW;
/**
 * Description of Controller
 *
 * @author horoshev
 */
class Controller {

    /**
     *
     * @var \FW\Request
     */
    protected $request;


    function __construct($request=null){
        $this->request = $request;
    }
    /**
     * 
     * @param \FW\Request $request
     * @return \FW\Controller Description
     */
    static function create(Request $request){
        $class_name = "Controller_".( implode("_", array_map("ucfirst", array_map("strtolower",explode("/",$request->controller)))));
        $controller = new $class_name($request);
        return $controller;
    }
    
    function execute(){
        $this->{"action_".$this->request->action}();
    }




}
?>
