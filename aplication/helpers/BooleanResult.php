<?php

require_once APPPATH . DS . "helpers" . DS . "interfaces" . DS . "IControl.php";

class BooleanResult implements IControl {

    public function controlResult(StefanController $controller, Rol $r, Group $g) {
        return $r->belong($g);
    }

    public function createResult(StefanController $controller, Rol $r, Group $g){
        return $r->canCreate($g);
    }

    public function updateResult(StefanController $controller, Rol $r, Group $g){
        return $r->canUpdate($g);
    }

    public function deleteResult(StefanController $controller, Rol $r, Group $g){
        return $r->canDelete($g);
    }

    public function searchResult(StefanController $controller, Rol $r, Group $g){
        return $r->canSearch($g);
    }

}
