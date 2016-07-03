<?php

class GroupController extends StefanController {

    static $name = "role";
    static $rootFolder = "rol";
    
    public function listAll() {
        try {
            $em = Ioc::getService("orm");
            $rols = $em->getRepository("Group")->findBy(array("isActive" => 1));
        } catch (Exception $ex) {
            $rols = array();
        }
        
        return $rols;
    }
}
