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

    public function findProvinces() {
        $result = "";
        $id = $this->getInput(INPUT_POST, "id");

        try {
            $em = Ioc::getService("orm");
            $countries = $em->getRepository("Country")->findBy(array("id" => $id));
            $em->flush();

            if (count($countries) > 0) {
                /* @var $country Country */
                $country = $countries[0];
                /* @var $p Province */
                foreach ($country->getProvinces() as $data) {
                    $result .= "<option value='" . $data->getId() . "'>" . $data->getDescription() . "</option>";
                }
            }
        } catch (Exception $ex) {
            $result = $ex->getMessage();
        } finally {
            echo $result;
        }
    }
    
    public function findStates(){
        $result = "";
        $id = $this->getInput(INPUT_POST, "id");

        try {
            $em = Ioc::getService("orm");
            $provinces = $em->getRepository("Province")->findBy(array("id" => $id));
            $em->flush();

            if (count($provinces) > 0) {
                /* @var $province Province */
                $province = $provinces[0];
                /* @var $p Province */
                foreach ($province->getStates() as $data) {
                    $result .= "<option value='" . $data->getId() . "'>" . $data->getDescription() . "</option>";
                }
            }
        } catch (Exception $ex) {
            $result = $ex->getMessage();
        } finally {
            echo $result;
        }
    }
    
    public function findCities() {
        $result = "";
        $id = $this->getInput(INPUT_POST, "id");

        try {
            $em = Ioc::getService("orm");
            $states = $em->getRepository("State")->findBy(array("id" => $id));
            $em->flush();

            if (count($states) > 0) {
                /* @var $state State */
                $state = $states[0];
                /* @var $data City */
                foreach ($state->getCities() as $data) {
                    $result .= "<option value='" . $data->getId() . "'>" . $data->getDescription() . "</option>";
                }
            }
        } catch (Exception $ex) {
            $result = $ex->getMessage();
        } finally {
            echo $result;
        }
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
                $arg["countries"] = array();
                try {
                    $em = Ioc::getService("orm");
                    $countries = $em->getRepository("Country")->findAll();
                    if (count($countries) > 0) {
                        $arg["countries"] = $countries;
                    }
                    $em->flush();
                } catch (Exception $ex) {
                    $arg["error"] = true;
                    $arg["errorMsg"] = $ex->getMessage();
                } finally {
                    $this->loadView(self::$rootFolder . DS . "step_2", $arg);
                }
                break;
            case 3:
                
                $this->loadView(self::$rootFolder . DS . "step_3", $arg);
                break;
            default:
                break;
        }
    }

}
