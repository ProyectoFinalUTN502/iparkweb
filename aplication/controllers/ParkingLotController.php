<?php

/**
 * ParkingLotController
 *
 * 
 */
class ParkingLotController extends StefanController {
    static $name = "parkinglot";
    static $rootFolder = "parkinglot";
    
    public function save($currentStep){
        $this->redirect(self::$rootFolder . DS . "step_1");
    }
    
    public function step($currentStep){
        
        $arg = array();
        $arg["error"] = false;
        $arg["errorMsg"] = "";
        
        switch($currentStep){
            case 1:
                $this->loadView(self::$rootFolder . DS . "step_1", $arg);
                break;
            case 2:
                $this->loadView(self::$rootFolder . DS . "step_2", $arg);
                break;
            case 3:
                $this->loadView(self::$rootFolder . DS . "step_3", $arg);
                break;
            default:
                break;
        }
        
    }
}
