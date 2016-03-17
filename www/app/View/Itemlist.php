<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of List
 *
 * @author horoshev
 */


class View_Itemlist extends View_Layout_Base {
    //put your code here
    protected $list = array();
    protected $actions = array();
    protected $name;
    
    
    function __construct(){
        parent::__construct();
    }
    
    function setList(array $list){
        $this->list = $list;
    }
    function addAction($name, $action){
        $this->$actions = $action;
    }
    
    
########################################
    function plist(){
########################################
   
########################################
    }
########################################

########################################
    function edit_form_bottom(){
###################################### ?>
   
        <div>
            <input type="button" name="save" value="Save">
            
            <input type="button" name="saveclose" value="Save & Close">
            
            <input type="button" name="cansel" value="Cansel">
        </div>     

<?php ###################################
    }
########################################
    
    
    
}


