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
class View_Json extends View {

    //put your code here

    protected $http_content_type = "application/json; charset=UTF-8";
    protected $scripts = array();
    protected $styles = array();
    protected $data;

    
    function http_response_body() {
        echo json_encode($this->data);
    }  
    
    public function setData($data){
        $this->data = $data;
    }
    
    

}
