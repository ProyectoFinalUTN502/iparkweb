<?php

class ParkingLotController extends StefanController {

    static $name = "parkinglot";
    static $rootFolder = "parkinglot";

    public function validate(ParkingLot $pl) {
        $result = true;
        $result = Validator::isNull($pl->getSsid()) ? false : $result;
        $result = Validator::isNull($pl->getName()) ? false : $result;
        $result = Validator::isNull($pl->getAddress()) ? false : $result;
        $result = Validator::isNull($pl->getLatMap()) ? false : $result;
        $result = Validator::isNull($pl->getLongMap()) ? false : $result;

        return $result;
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

    public function findStates() {
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

    public function saveLayout() {

        $layouts = array();
        $post = $this->getAllPost();
        $step3 = $this->loadFromSession("step_3");

        if ($step3 != false) {
            $layouts = $step3;
        }
        array_push($layouts, base64_encode($post));

        $this->saveInSession("currentStep", 3);
        $this->saveInSession("step_3", $layouts);
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
                $arg["vTypes"] = array();
                try {
                    $em = Ioc::getService("orm");
                    $vtypes = $em->getRepository("VehicleType")->findBy(array("isActive" => 1));
                    if (count($vtypes) > 0) {
                        $arg["vTypes"] = $vtypes;
                    }
                } catch (Exception $ex) {
                    $arg["error"] = true;
                    $arg["errorMsg"] = $ex->getMessage();
                } finally {
                    $this->loadView(self::$rootFolder . DS . "step_3", $arg);
                }
                break;
            default:
                break;
        }
    }

    public function save($currentStep) {

        $nextStep = $currentStep + 1;

        $post = $this->getAllPost();
        $this->saveInSession("currentStep", $currentStep);
        $this->saveInSession("step_" . $currentStep, $post);
        $this->redirect(self::$rootFolder . DS . "step/" . $nextStep);
    }

    public function cancel() {
        $steps = $this->loadFromSession("currentStep");
        if ($steps != false) {
            for ($i = 1; $i <= $steps; $i++) {
                $this->deleteFromSession("step_" . $i);
            }
            $this->deleteFromSession("currentStep");
        }

        $this->redirect("admin/main");
    }

    public function register() {

        $step1 = $this->loadFromSession("step_1");
        $step2 = $this->loadFromSession("step_2");
        $step3 = $this->loadFromSession("step_3");

        $exp = ($step1 != false && $step2 != false && $step3 != false);
        if ($exp) {

            $opUser = $this->generateClientUser($step1);
            if ($opUser->isError()) {
                echo $opUser;
                exit();
            }

            /* @var $user User */
            $user = $opUser->getData();

            $opPl = $this->generateParkingLot($step2);
            if ($opPl->isError()) {
                echo $opPl;
                exit();
            }

            /* @var $parkinglot Parkinglot */
            $parkinglot = $opPl->getData();

            $this->generateLayout($parkinglot, $step3);

            $parkinglot->setUser($user);
            $user->addParkingLot($parkinglot);
            try {
                $em = Ioc::getService("orm");
                $em->persist($user);
                $em->flush();
            } catch (Exception $ex) {
                echo $ex->getCode() . " " . $ex->getMessage();
            }
        } else {
            // IR A PANTALLA DE ERROR
            echo "Hubo un error con la informacion almacenada";
        }
    }

    private function generateClientUser($data) {

        $result = new Operation();

        $user = $this->filter($data["user"]);
        $password = $this->filter($data["password"]);
        $repassword = $this->filter($data["repassword"]);
        $name = $this->filter($data["name"]);
        $lastName = $this->filter($data["lastName"]);
        $email = $this->filter($data["email"]);

        if ($password == $repassword) {
            $em = Ioc::getService("orm");
            /* @var $rol Rol */
            $rol = $em->find("Rol", 2);

            $usr = new User();
            $usr->setUser($user);
            $usr->setPassword(Security::generateHash($password, new SHA256()));
            $usr->setName($name);
            $usr->setLastName($lastName);
            $usr->setEmail($email);
            $usr->setRole($rol);

            $uc = new UserController();
            $validation = $uc->validate($usr, new UserNew());

            if ($validation) {
                $result->setData($usr);
            } else {
                $result->setMessage("La informacion ingresada no es valida");
            }
        } else {
            $result->setMessage("Las Contrase&ntilde;as debe coincidir");
        }

        return $result;
    }

    private function generateParkingLot($data) {

        $result = new Operation();

        $ssid = $this->filter($data["ssid"]);
        $name = $this->filter($data["name"]);
        $description = $this->filter($data["description"]);
        $address = $this->filter($data["address"]);
        $isCovered = $this->filter($data["isCovered"]);
        $latMap = $this->filter($data["lat"]);
        $longMap = $this->filter($data["lng"]);
        $openTime = $this->filter($data["openTime"]);
        $closeTime = $this->filter($data["closeTime"]);
        $cityId = $this->filter($data["city"]);

        $pl = new Parkinglot();
        $pl->setSsid($ssid);
        $pl->setName($name);
        $pl->setDescription($description);
        $pl->setAddress($address);
        $pl->setIsCovered($isCovered);
        $pl->setLatMap($latMap);
        $pl->setLongMap($longMap);
        $pl->setOpenTime($openTime);
        $pl->setCloseTIme($closeTime);

        $em = Ioc::getService("orm");
        $city = $em->find("City", $cityId);

        $pl->setCity($city);
        if ($this->validate($pl)) {
            $result->setData($pl);
        } else {
            $result->setMessage("La informacion ingresada no es valida");
        }

        return $result;
    }

    private function generateLayout(ParkingLot &$pl, $data) {

        for ($i = 0; $i < count($data); $i++) {

            $dl = base64_decode($data[$i]);

            $floor = $this->filter($dl["floor"]);
            $maxRows = $this->filter($dl["maxRows"]);
            $maxCols = $this->filter($dl["maxCols"]);

            $temp = html_entity_decode($this->filter($dl["data"]));
            $dataLy = json_decode($temp);


            $layout = new Layout();
            $layout->setFloor($floor);
            $layout->setMaxRows($maxRows);
            $layout->setMaxCols($maxCols);
            $layout->setParkinglot($pl);

            $this->generateLayoutPosition($layout, $dataLy);
        }
    }

    private function generateLayoutPosition(Layout &$ly, $data) {
        foreach ($data as $obj) {
            
            $vt = VehicleTypeController::findByColor($obj->color);
            
            if($vt != null){
                $lyp = new FreeLayoutPosition();

                $posArray = explode("-", $obj->id);
                $x = $posArray[0];
                $y = $posArray[1];
                
                $circulationValue = $obj->cv;
                
                $lyp->setXPoint($x);
                $lyp->setYPoint($y);
                $lyp->setCirculationValue($circulationValue);
                $lyp->setValid(1);
                $lyp->setVehicleType($vt);
                $lyp->setLayout($ly);
                
                $ly->addLayoutPosition($lyp);
                
            }
        }
    }

}
