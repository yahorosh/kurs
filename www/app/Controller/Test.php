<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
use FW\FW,
    FW\Validator
;
/**
 * Description of Index
 *
 * @author horoshev
 */

class Controller_Test extends \FW\Controller{
    //put your code here



    
    function action_index(){
         $em = FW::getEM();
         
         /**
          * @var Entity\Student Description
          */
         //$students = $em->getRepository('Entity\Student')->find(1);

         $a = new Entity\Group; //$em->getRepository('Entity\Subject')->find(1);

         $a->setName("Group test ".rand(100,9999999));
         $b = new Entity\GroupHasSubject;
         
         
         $b->setSubject($em->getRepository('Entity\Subject')->find(1));
         
         $b->setType('both');
         $a->addGroupHasSubject($b);
         
         $ghj = $a->getGroupHasSubjects();
         foreach($ghj as $v){
             echo "<br>".$v->getSubject()->getName();
         }

//var_dump($department->getFaculty());
         
         /*$group = new Entity\Group;
         
         $group->setDepartment($department);
         
         $em->persist($group);
         $em->flush();
         */
         
         
         $em->persist($a);
         $em->flush();
         
         $em->refresh($a);
         
         
         $ghj = $a->getGroupHasSubjects();
         foreach($ghj as $v){
             echo "<br>".$v->getSubject()->getName();
         }
         
         
         echo "<br/><br/>";
         
         //$ar= $a->getLecturers();
         
         //count($group->getStudents());
         //$group->getDepartment()->id();
         //count($group->getSubjects());
         
         
         
         //$ar = $group->to_array('department.faculty','students');
        /* //$ar['department'] = $group->getDepartment() ? $group->getDepartment()->to_array() : null;  
         
         foreach($ar as $v){
             echo $v->getName();
             echo "<br/>";
         }
         */
         
         //var_dump($ar);
         
         echo "<br>";
         //var_dump($n->as_array());
         //$students->setGroup(1);
         
         
         //$q = $em->createQuery('SELECT s , g, d FROM Entity\Student s LEFT JOIN s.group g LEFT JOIN g.department d ');
         //$students = $q->getArrayResult();
         //$s=$students->as_array();
         //$newstudent = new Entity\Student();
         //$newstudent->set_all($s);
         //$view = new View_Students();
         //$view->display();
    }
    
    
    function action_itemlist(){

        $em = FW::getEM();
        //var_dump($s->as_array());
        $students = $em->getRepository('Entity\Student')->findAll();
        $students = array_map(function($v){return $v->as_array();}, $students);
        echo json_encode($students);
        
    }

}
?>