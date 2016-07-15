<?php

class ParamController extends StefanController {

    static $name = "param";
    static $rootFolder = "param";

    public function edit() {

        try {
            $em = Ioc::getService("orm");

            $post = $_POST;

            unset($post["submit"]);
            foreach ($post as $k => $v) {

                $filteredKey = $this->filter($k);
                $filteredValue = $this->filter($v);

                $params = $em->getRepository("Param")->findBy(array("keyParam" => $filteredKey));
                if (count($params) == 0) {
                    $this->redirect("admin/error");
                    break;
                }
                $param = $params[0];
                $param->setValueParam($filteredValue);

                $em->merge($param);
            }
            $em->flush();
            $this->redirect("admin/main");
        } catch (Exception $ex) {
            $arg = array();
            $arg["error"] = true;
            $arg["errorMsg"] = $ex->getMessage();
            $arg["params"] = array();
            $this->loadView(self::$rootFolder . DS . "list", $arg);
        }
    }

    public function all() {

        try {
            $em = Ioc::getService("orm");
            $params = $em->getRepository("Param")->findAll();

            $arg = array();
            $arg["error"] = false;
            $arg["errorMsg"] = "";
            $arg["params"] = $params;
        } catch (Exception $ex) {
            $arg = array();
            $arg["error"] = true;
            $arg["errorMsg"] = $ex->getMessage();
            $arg["params"] = array();
        } finally {
            $this->loadView(self::$rootFolder . DS . "list", $arg);
        }
    }

}
