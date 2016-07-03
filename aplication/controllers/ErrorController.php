<?php

class ErrorController extends StefanController {
    static $name = "error";
    static $rootFolder = "";
    
    public function load(){
        Session::close();
        $this->loadView("error");
    }
    
   
    
}
