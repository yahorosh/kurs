<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use FW\FW,
    FW\View,
    FW\Exeption_Validate,
    FW\Validator

;

/**
 * Description of Index
 *
 * @author horoshev
 */
class Controller_Rest_Group extends Controller_Rest {

    //put your code here



    function action_get() {

        $em = FW::getEM();
        if ($studId = $this->request->params('id')) {
            $groups = $em->getRepository('Entity\Group')->find($studId);
            $groups = $groups ? $groups->to_array('group_has_subjects.subject') : null;
        } else {
            $q = $em->createQuery('SELECT g, d, f, ghs, sj FROM Entity\Group g LEFT JOIN g.department d LEFT JOIN d.faculty f LEFT JOIN g.group_has_subjects ghs LEFT JOIN ghs.subject sj ORDER BY f.name, d.name, g.name');
            $groups = $q->getArrayResult();
        }

        $view = View::create(array("FW", "json"), array());
        if ($groups) {
            $view->setData($groups);
        } elseif($studId) {
            $view->setHttpResponseCode(404);
        } else {
            $view->setData(array());
        }
        $view->display();
    }
    
    function action_get_subjects(){
        
    }
    

    function action_post() {
        $em = FW::getEM();
        $json = json_decode(implode("", file("php://input")), true);

        $view = View::create("json");

        $group = new Entity\Group();
        
        if(is_array($json['group_has_subjects'])){ 
                foreach($json['group_has_subjects'] as $k=>$v){
                    unset($json['group_has_subjects'][$k]['subject']); 
                    unset($json['group_has_subjects'][$k]['lecturer']);
                    unset($json['group_has_subjects'][$k]['group']); 
                    
                    //$json['group_has_subjects'][$k]['subject'] = $json['group_has_subjects'][$k]['id_subject'];
                    //$json['group_has_subjects'][$k]['lecturer'] = $json['group_has_subjects'][$k]['id_lecturer'];
                    
                    if(!key_exists('id_subject', $v)){
                        unset($json['group_has_subjects'][$k]);
                    }
                    
                }
            }
            
            $subjects = $json['group_has_subjects'];
            unset($json['group_has_subjects']);
            
        if ($group->from_array($json)) {
            $em->persist($group);
            $em->flush();
            
                foreach($subjects as $k=>$v){
                    $ghs = new Entity\GroupHasSubject;
                    if($v['id_subject']) $ghs->setSubject($em->getRepository("Entity\Subject")->find($v['id_subject']));
                    if($v['id_lecturer']) $ghs->setLecturer($em->getRepository("Entity\Lecturer")->find($v['id_lecturer']));
                    if($v['type']) $ghs->setType($v['type']);
                    $ghs->setGroup($group);
                    $em->persist($ghs);
                }
               
                $em->flush();
                $em->refresh($group);
                foreach($group->getGroupHasSubjects() as $v) { $em->refresh ($v);}
            
            $view->setData($group->to_array('department.faculty','group_has_subject'));
        } else {
            $view->setHttpResponseCode(400);
            $view->setData($group->getValidator()->getErrors());
        }

        $view->display();
    }

    function action_put() {

        $em = FW::getEM();
        $code = 200;
        $json = json_decode(implode("", file("php://input")), true);
        //var_dump($json);
        $view = View::create("json");
        try {
            $studId = $this->request->params('id');
            if (!$studId) {
                $code = 400;
                throw new Exeption_Validate("Bad request. Empty ID.");
            }
            $group = new Entity\Group;
            $group = $em->getRepository('Entity\Group')->find($studId);
            if (!$group) {
                $code = 404;
                throw new Exeption_Validate("Entity not found.");
            }
            
            //$q = $em->createQuery('DELETE Entity\GroupHasSubjects ghs WHERE ghs.id_group='.$group->getIdGroup());
            //$q->setParameter(1,$group->getIdGroup());
            //$groups = $q->getArrayResult();

   
            $ss=$group->getGroupHasSubjects();
            foreach($ss as $v){
                $em->remove($v);
            }
            $em->flush();
            
                
            
            unset($json['department']['faculty']);
            if(is_array($json['group_has_subjects'])){ 
                foreach($json['group_has_subjects'] as $k=>$v){
                    unset($json['group_has_subjects'][$k]['subject']); 
                    unset($json['group_has_subjects'][$k]['lecturer']);
                    unset($json['group_has_subjects'][$k]['group']);
                    if(!key_exists('id_subject', $v)){
                        unset($json['group_has_subjects'][$k]);
                    }
                    
                }
            }
            
            $subjects = $json['group_has_subjects'];
            unset($json['group_has_subjects']);
            
            

            

            
            if ($group->from_array($json)) {
                $em->persist($group);
                $em->flush();
                
                foreach($subjects as $k=>$v){
                    $ghs = new Entity\GroupHasSubject();
                    if($v['id_subject']) $ghs->setSubject($em->getRepository("Entity\Subject")->find($v['id_subject']));
                    if($v['id_lecturer']) $ghs->setLecturer($em->getRepository("Entity\Lecturer")->find($v['id_lecturer']));
                    if($v['type']) $ghs->setType($v['type']);
                    
                    $ghs->setGroup($group);
                    $em->persist($ghs);
                }
                
                $em->flush();
                $em->refresh($group);
                foreach($group->getGroupHasSubjects() as $v) { $em->refresh ($v);}
                
                
                $view->setData($group->to_array('department.faculty','group_has_subjects.subject'));
            } else {
                $code = 400;
                $view->setData($group->getValidator()->getErrors());
            }
        } catch (Exeption_Validate $e) {
            $view->setData(array("message" => (string) $e));
        }
        $view->setHttpResponseCode($code);
        $view->display();
    }

    function action_delete() {
        $em = FW::getEM();
        $studId = $this->request->params('id');
        $group = new Entity\Group;
        $group = $em->getRepository('Entity\Group')->find($studId);
        
        $group->getStudents()->map(function($p)use($em){ 
            $p->setGroup();$em->persist($p);}
        );
        $group->getGroupHasSubjects()->map(function($p)use($em){ 
             $em->remove($p);
        });
        $em->flush();
        $em->remove($group);
        $em->flush();
        $view = View::create("json");
        $view->setData($group->to_array());
        $view->display();
    }

}

