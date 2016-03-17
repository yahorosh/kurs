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
class Controller_Rest_Department extends Controller_Rest {

    //put your code here



    function action_get() {

        $em = FW::getEM();
        if ($itemId = $this->request->params('id')) {
            $items = $em->getRepository('Entity\Department')->find($itemId);
            $items = $items ? $items->as_array() : null;
        } else {
            $q = $em->createQuery('SELECT d, f FROM Entity\Department d LEFT JOIN d.faculty f ORDER BY f.name');
            $items = $q->getArrayResult();
        }

        $view = View::create(array("FW", "json"), array());
        if ($items) {
            $view->setData($items);
        } elseif($itemId) {
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

        $item = new Entity\Department();


        if ($item->from_array($json)) {
            $em->persist($item);
            $em->flush();
            $view->setData($item->to_array('faculty'));
        } else {
            $view->setHttpResponseCode(400);
            $view->setData($item->getValidator()->getErrors());
        }



        $view->display();
    }

    function action_put() {

        $em = FW::getEM();
        $code = 200;
        $json = json_decode(implode("", file("php://input")), true);
        $view = View::create("json");
        try {
            $itemId = $this->request->params('id');
            if (!$itemId) {
                $code = 400;
                throw new Exeption_Validate("Bad request. Empty ID.");
            }
            $item = $em->getRepository('Entity\Department')->find($itemId);
            if (!$item) {
                $code = 404;
                throw new Exeption_Validate("Entity not found.");
            }

            if ($item->from_array($json)) {
                $em->persist($item);
                $em->flush();
                $view->setData($item->to_array('faculty'));
            } else {
                $view->setHttpResponseCode(400);
                $view->setData($item->getValidator()->getErrors());
            }
        } catch (Exeption_Validate $e) {
            $view->setData(array("message" => (string) $e));
        }
        $view->setHttpResponseCode($code);
        $view->display();
    }

    function action_delete() {
        $em = FW::getEM();
        $itemId = $this->request->params('id');
        $item = $em->getRepository('Entity\Department')->find($itemId);
        $em->remove($item);
        $em->flush();
        $view = View::create("json");
        $view->setData($item->to_array());
        $view->display();
    }

}

