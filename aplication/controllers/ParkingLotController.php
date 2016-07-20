<?php

/**
 * ParkingLotController
 *
 * 
 */
class ParkingLotController extends StefanController {

    static $name = "parkinglot";
    static $rootFolder = "parkinglot";

    public function save($currentStep) {
        $this->redirect(self::$rootFolder . DS . "step_1");
    }

    public function findLocation() {
        $address = $this->getInput(INPUT_POST, "address");
        $result = array();
        $result["status"] = "ERROR";
        $result["lat"] = "";
        $result["lng"] = "";

        if ($address != null) {
            $response = Geocoder::getLocation($address);
            if (!empty($response)) {
                $result["status"] = "OK";
                $result["lat"] = $response["lat"];
                $result["lng"] = $response["lng"];
            }
        }
        echo json_encode($result);
    }

    public function step($currentStep) {

        $arg = array();
        $arg["error"] = false;
        $arg["errorMsg"] = "";

        switch ($currentStep) {
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
