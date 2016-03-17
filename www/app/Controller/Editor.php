<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
use FW\FW;
/**
 * Description of Index
 *
 * @author horoshev
 */

class Controller_Editor extends \FW\Controller{
    //put your code here


    function action_index(){
        $view = new View_Students();
        $view->action = $this->request->action;
        $view->display();
        
    }

    
    function action_students(){
        $view = new View_Students(); 
        $view->action = $this->request->action;
        $view->display();
        
    }
    
    function action_groups(){
        $view = new View_Groups();
        $view->action = $this->request->action;
        $em = \FW\FW::getEM();
        $view->subjects = $em->getRepository("Entity\Subject")->findAll();
        $view->display();
        
    }
    
    function action_departments(){
        $view = new View_Departments();
        $view->action = $this->request->action;
        $view->display();
        
    }
    
    function action_faculties(){
        $view = new View_Faculties();
        $view->action = $this->request->action;
        $view->display();
    }
    
    function action_deans(){
        $view = new View_Deans();
        $view->action = $this->request->action;
        $view->display();
    }
    
    function action_lecturers(){
        $view = new View_Lecturers();
        $view->action = $this->request->action;
        $em = \FW\FW::getEM();
        $view->subjects = $em->getRepository("Entity\Subject")->findAll();
        
        $view->display();
    }
    
    function action_subjects(){
        $view = new View_Subjects();
        $view->action = $this->request->action;
        $view->display();
    }
   
    

}


