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
class Controller_Rest_Student extends Controller_Rest {

    //put your code here



    function action_get() {

        $em = FW::getEM();
        if ($studId = $this->request->params('id')) {
            $students = $em->getRepository('Entity\Student')->find($studId);
            $students = $students ? $students->as_array() : null;
        } else {
            $q = $em->createQuery('SELECT s , g, d, dt FROM Entity\Student s LEFT JOIN s.group g LEFT JOIN g.department d LEFT JOIN d.faculty f LEFT JOIN s.depts dt ORDER BY s.name');
            $students = $q->getArrayResult();
        }



        $view = View::create(array("FW", "json"), array());
        if ($students) {
            array_walk($students, array($this, 'preFormat'));
            $view->setData($students);
        } elseif ($studId) {
            $view->setHttpResponseCode(404);
        } else {
            $view->setData(array());
        }
        $view->display();
    }

    function action_post() {
        $em = FW::getEM();
        $json = json_decode(implode("", file("php://input")), true);

        $view = View::create("json");

        $student = new Entity\Student();


        $depts = $json['depts'];
        unset($json['depts']);

        if ($student->from_array($json)) {
            $em->persist($student);
            $em->flush();
           

                foreach (is_array($depts) ? $depts :array () as $k => $v) {
                    $dept = new Entity\Dept();
                    if ($ghs = $em->getRepository("Entity\GroupHasSubject")->find($v['id_group_has_subject']))
                        $dept->setGroupHasSubject($ghs);
                    $dept->setValueCredit($v['value_credit']);
                    $dept->setValueExam($v['value_exam']);
                    $dept->setStudent($student);
                    $em->persist($dept);
                }
                $em->flush();
                $em->refresh($student);

                foreach ($student->getDepts() as $v)
                    $em->refresh($v);
            
            
            $view->setData($this->preFormat($student->to_array('group', 'group.department')));
        } else {
            $view->setHttpResponseCode(400);
            $view->setData($student->getValidator()->getErrors());
        }



        $view->display();
    }

    function action_put() {

        $em = FW::getEM();
        $code = 200;
        $json = json_decode(implode("", file("php://input")), true);
        $view = View::create("json");
        try {
            $studId = $this->request->params('id');
            if (!$studId) {
                $code = 400;
                throw new Exeption_Validate("Bad request. Empty ID.");
            }
            $student = $em->getRepository('Entity\Student')->find($studId);
            if (!$student) {
                $code = 404;
                throw new Exeption_Validate("Entity not found.");
            }

            foreach ($student->getDepts() as $k => $v) {
                $em->remove($v);
            }
            $em->flush();


            $depts = $json['depts'];
            unset($json['depts']);

            if ($student->from_array($json)) {
                $em->persist($student);
                $em->flush();

                foreach ($depts as $k => $v) {
                    $dept = new Entity\Dept();
                    if ($ghs = $em->getRepository("Entity\GroupHasSubject")->find($v['id_group_has_subject']))
                        $dept->setGroupHasSubject($ghs);
                    $dept->setValueCredit($v['value_credit']);
                    $dept->setValueExam($v['value_exam']);
                    $dept->setStudent($student);
                    $em->persist($dept);
                }
                $em->flush();
                $em->refresh($student);

                foreach ($student->getDepts() as $v)
                    $em->refresh($v);



                $view->setData($this->preFormat($student->to_array('group.department.faculty', 'depts')));
            } else {
                $code = 400;
                $view->setData($student->getValidator()->getErrors());
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
        $student = $em->getRepository('Entity\Student')->find($studId);
        $em->remove($student);
        $em->flush();
        $view = View::create("json");
        $view->setData($this->preFormat($student->to_array()));
        $view->display();
    }

    protected function preFormat(array &$data) {
        $data['rec_date'] = date("Y-m-d", $data['rec_date']);
        return $data;
    }

}

