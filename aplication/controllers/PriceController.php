<?php

class PriceController extends StefanController {

    static $name = "price";
    static $rootFolder = "price";
    
    public function all() {
        $userId = $this->loadFromSession("userID");
        $parkinglot = ParkingLotController::getUserParkinglot($userId);
        
        if ($parkinglot == NULL) {
            $this->redirect("admin/error");
        }
        
        $vtypes = $parkinglot->getVehicleTypesUsed();
        
        $arg = array();
        $arg["vTypes"] = count($vtypes) > 0 ? $vtypes : array();
        $arg["pkl"] = $parkinglot;
        $arg["error"] = false;
        $arg["errorMsg"] = "";
        $this->loadView(self::$rootFolder . DS . "list", $arg);
    }
    
    public function register() {
        /* @var $parkinglot Parkinglot */
        $em = Ioc::getService("orm");
        $userId = $this->loadFromSession("userID");
        $parkinglot = ParkingLotController::getUserParkinglot($userId);
        
        if ($parkinglot == NULL) {
            $this->redirect("admin/error");
        }
        
        $post = $this->getAllPost();
        //unset($post["submit"]);
        
        try {
            foreach ($parkinglot->getPrices() as $p) {
                $em->remove($p);
            }
            $em->flush();
            
            foreach ($post as $k => $v) {
                $id = $this->filter($k);
                $value = $this->filter($v);

                $vt = $em->find("VehicleType", $id);
                $em->flush();
                if ($vt != NULL) {
                    $price = new Price();
                    $price->setPrice($value);
                    $price->setVehicleType($vt);
                    $price->setParkinglot($parkinglot);

                    $parkinglot->addPrice($price);
                    
                }
            }
            $em->merge($parkinglot);
            $em->flush();

            $this->redirect("admin/main");
        } catch (Exception $ex) {
            $vTypes = $parkinglot->getVehicleTypesUsed();
            
            $arg = array();
            $arg["vTypes"] = count($vTypes) > 0 ? $vTypes : array();
            $arg["pkl"] = $parkinglot;
            $arg["error"] = true;
            $arg["errorMsg"] = $ex->getMessage();
            $this->loadView(self::$rootFolder . DS . "list", $arg);
        }
    }

}
