<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Index
 *
 * @author horoshev
 */

class Controller_Index extends FW\Controller{
    //put your code here


    function action_index(){
        $view = new View_Index();
        $view->display();
        
        
        
        
        //$t = 'bla bla $bla bla';
        //$a = array('bla' => '123');
        
      // $t = preg_match_all('~\{\w+\}~is', $t,$m) ? strtr(array_walk($m[0], function($v,$k) use {} ),$m[0], $t) : $t;
        
        
    }


}
?>
