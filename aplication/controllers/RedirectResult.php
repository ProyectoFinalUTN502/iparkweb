<?php

require_once APPPATH . DS . "controllers" . DS . "IControl.php";

class RedirectResult implements IControl {

    public function controlResult(StefanController $controller, Rol $r, Group $g) {
        if (!$r->belong($g)) {
            $controller->redirect("admin/forbidden");
        }
    }

    public function createResult(StefanController $controller, Rol $r, Group $g){
        if(!$r->canCreate($g)){
            $controller->redirect("admin/forbidden");
        }
    }

    public function updateResult(StefanController $controller, Rol $r, Group $g){
        if(!$r->canUpdate($g)){
            $controller->redirect("admin/forbidden");
        }
    }

    public function deleteResult(StefanController $controller, Rol $r, Group $g){
        if(!$r->canDelete($g)){
            $controller->redirect("admin/forbidden");
        }
    }

    public function searchResult(StefanController $controller, Rol $r, Group $g){
        if(!$r->canSearch($g)){
            $controller->redirect("admin/forbidden");
        }
    }
}
