<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FW;

/**
 * Description of View
 *
 * @author horoshev
 */
class View_Html extends View {

    //put your code here

    protected $http_content_type = "text/html; charset=utf-8";
    public $title = "Default title page";
    protected $scripts = array();
    protected $styles = array();

    function http_response_body() {
        $this->html();
    }  
    
    function scripts() {
        foreach ($this->scripts as $k => $v) {
            echo  '<script src="' . $v . '"></script>' . "\n";
        }
    }

    function styles() {
        echo "\n";
        foreach ($this->styles as $k => $v) {
            if(is_callable($v)){
                call_user_func($v);
            } else {
                echo '<link type="text/css" rel="stylesheet" href="' . $v. '" />' . "\n";
            }    
        }
        echo "\n";
    }
    
   
    
    function addScript($script){
        $this->scripts[] = $script;
    }
    
    function addStyle($style){
        $this->styles[] = $style;
    }
    
   
    function html(){
        echo "default content";
    }
    
    

}
