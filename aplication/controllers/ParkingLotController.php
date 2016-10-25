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

    public static function getUserParkinglot($userId) {
        try {
            $result = NULL;
            
            /* @var $user User */
            $em = Ioc::getService("orm");
            $user = $em->find("User", $userId);
            $em->flush();
            
            if ($user != NULL){
                $parkinglot = $user->getParkinglots()->first();
                $result = $parkinglot;
            }
            
        } catch (Exception $ex) {
            $result = NULL;
        }
        
        return $result;
    }
    
    public function saveLayout() {

        $layouts = array();
        $step3 = $this->loadFromSession("step_3");

        if ($step3 != false) {
            $layouts = $step3;
        }

        $postInfo = array();
        $postInfo["floor"] = $this->getInput(INPUT_POST, "floor");
        $postInfo["maxRows"] = $this->getInput(INPUT_POST, "maxRows");
        $postInfo["maxCols"] = $this->getInput(INPUT_POST, "maxCols");
        $postInfo["data"] = $this->getInput(INPUT_POST, "data");

        array_push($layouts, $postInfo);

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

                try {
                    $em = Ioc::getService("orm");
                    $countries = $em->getRepository("Country")->findAll();
                    $em->flush();

                    $arg["pkl"] = NULL;
                    $arg["countries"] = count($countries) > 0 ? $countries : array();
                } catch (Exception $ex) {
                    $arg["pkl"] = NULL;
                    $arg["countries"] = array();
                    $arg["error"] = true;
                    $arg["errorMsg"] = $ex->getMessage();
                } finally {
                    $this->loadView(self::$rootFolder . DS . "step_2", $arg);
                }
                break;
            case 3:
                try {
                    $em = Ioc::getService("orm");
                    $vtypes = $em->getRepository("VehicleType")->findBy(array("isActive" => 1));

                    $arg["pkl"] = NULL;
                    $arg["vTypes"] = count($vtypes) > 0 ? $vtypes : array(); 
                } catch (Exception $ex) {
                    $arg["pkl"] = NULL;
                    $arg["vTypes"] = array(); 
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

        $this->redirect(self::$name . DS . "all");
    }

    public function register() {
        $step1 = $this->loadFromSession("step_1");
        $step2 = $this->loadFromSession("step_2");
        $step3 = $this->loadFromSession("step_3");

        $exp = ($step1 != false && $step2 != false && $step3 != false);
        if ($exp) {

            $opUser = $this->generateClientUser($step1);
            if ($opUser->isError()) {
                $this->fail($opUser->getMessage());
                exit();
            }

            /* @var $user User */
            $user = $opUser->getData();

            $opPl = $this->generateParkingLot($step2);
            if ($opPl->isError()) {
                $this->fail($opPl->getMessage());
                exit();
            }

            /* @var $parkinglot Parkinglot */
            $parkinglot = $opPl->getData();
            $parkinglot->setUser($user);
            $user->addParkingLot($parkinglot);

            $this->generateLayout($parkinglot, $step3);


            try {
                $em = Ioc::getService("orm");
                $em->persist($user);
                $em->flush();
                $this->redirect(self::$name . DS . "success");
            } catch (Exception $ex) {
                $this->fail($ex->getMessage());
            }
        } else {
            $this->fail("Ocurrio un error con la informacion almacenada");
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
                $result->setError();
                $result->setMessage("El Usuario ingresado no contiene informacion valida");
            }
        } else {
            $result->setError();
            $result->setMessage("Las Contrase&ntilde;as ingresada en el Usuario no es valida");
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

        /* @var $city City */
        $em = Ioc::getService("orm");
        $city = $em->find("City", $cityId);

        $pl->setCity($city);
        $city->addParkinglot($pl);

        if ($this->validate($pl)) {
            $result->setData($pl);
        } else {
            $result->setError();
            $result->setMessage("El Establecimiento ingresado no contiene informacion valida");
        }

        return $result;
    }

    private function generateLayout(ParkingLot &$parkingLot, $data) {

        for ($i = 0; $i < count($data); $i++) {

            $dl = $data[$i];

            $floor = $dl["floor"];
            $maxRows = $dl["maxRows"];
            $maxCols = $dl["maxCols"];

            $temp = html_entity_decode($dl["data"]);
            $positionData = json_decode($temp);


            $layout = new Layout();
            $layout->setFloor($floor);
            $layout->setMaxRows($maxRows);
            $layout->setMaxCols($maxCols);
            $layout->setParkinglot($parkingLot);

            $parkingLot->addLayout($layout);
            $this->generateLayoutPosition($layout, $positionData);
        }
    }

    private function generateLayoutPosition(Layout &$layout, $data) {
        foreach ($data as $obj) {

            $x = $obj->x;
            $y = $obj->y;
            $valid = $obj->valid;
            $circulationValue = $obj->cv;
            $vtId = $obj->vt;
            $in = $obj->in;
            $out = $obj->out;
            $rin = $obj->rin;
            $rout = $obj->rout;


            $position = new FreeLayoutPosition();
            $position->setXPoint($x);
            $position->setYPoint($y);
            $position->setCirculationValue($circulationValue);
            $position->setValid($valid);
            $position->setLayout($layout);
            $position->setIn($in);
            $position->setOut($out);
            $position->setRIn($rin);
            $position->setROut($rout);
            $layout->addLayoutPosition($position);

            if ($vtId != 0) {
                /* @var $vt VehicleType */
                $vt = VehicleTypeController::find($vtId);
                $position->setVehicleType($vt);
                $vt->addLayoutPosition($position);
            }
        }
    }

    public function success() {
        $this->deleteFromSession("step_1");
        $this->deleteFromSession("step_2");
        $this->deleteFromSession("step_3");
        $this->deleteFromSession("currentStep");

        $arg = array();
        $arg["error"] = false;
        $arg["msg"] = "";

        $this->loadView(self::$rootFolder . DS . "result", $arg);
    }

    public function fail($msg) {
        $this->deleteFromSession("step_1");
        $this->deleteFromSession("step_2");
        $this->deleteFromSession("step_3");
        $this->deleteFromSession("currentStep");

        $arg = array();
        $arg["error"] = true;
        $arg["msg"] = $msg;

        $this->loadView(self::$rootFolder . DS . "result", $arg);
    }

    public function edit($id) {
        $id = $this->filter($id);

        $ssid = $this->getInput(INPUT_POST, "ssid");
        $name = $this->getInput(INPUT_POST, "name");
        $description = $this->getInput(INPUT_POST, "description");
        $address = $this->getInput(INPUT_POST, "address");
        $isCovered = $this->getInput(INPUT_POST, "isCovered");
        $latMap = $this->getInput(INPUT_POST, "lat");
        $longMap = $this->getInput(INPUT_POST, "lng");
        $openTime = $this->getInput(INPUT_POST, "openTime");
        $closeTime = $this->getInput(INPUT_POST, "closeTime");
        $cityId = $this->getInput(INPUT_POST, "city");

        $em = Ioc::getService("orm");

        $criteria = array("id" => $id, "isActive" => 1);
        $parkinglots = $em->getRepository("Parkinglot")->findBy($criteria);
        $countries = $em->getRepository("Country")->findAll();

        $city = $em->find("City", $cityId);

        if (count($parkinglots) == 0) {
            $this->redirect("admin/error");
        }

        /* @var $pkl Parkinglot */
        $pkl = $parkinglots[0];
        $pkl->setSsid($ssid);
        $pkl->setName($name);
        $pkl->setDescription($description);
        $pkl->setAddress($address);
        $pkl->setIsCovered($isCovered);
        $pkl->setLatMap($latMap);
        $pkl->setLongMap($longMap);
        $pkl->setOpenTime($openTime);
        $pkl->setCloseTIme($closeTime);
        $pkl->setCity($city);

        if ($this->validate($pkl)) {
            try {
                $em->merge($pkl);
                $em->flush();
                $this->redirect(self::$name . DS . "all");
            } catch (Exception $ex) {
                $arg = array();
                $arg["pkl"] = $pkl;
                $arg["countries"] = count($countries) > 0 ? $countries : array();
                $arg["error"] = true;
                $arg["errorMsg"] = $ex->getMessage();
                $this->loadView(self::$rootFolder . DS . "step_2", $arg);
            }
        } else {
            $arg = array();
            $arg["pkl"] = $pkl;
            $arg["countries"] = count($countries) > 0 ? $countries : array();
            $arg["error"] = true;
            $arg["errorMsg"] = "La informacion ingresada no es valida";
            $this->loadView(self::$rootFolder . DS . "step_2", $arg);
        }
    }

    public function editLayout($id) {
        $id = $this->filter($id);
        
        $em = Ioc::getService("orm");
        $criteria = array("id" => $id, "isActive" => 1);
        $parkinglots = $em->getRepository("Parkinglot")->findBy($criteria);
        $vtypes = $em->getRepository("VehicleType")->findBy(array("isActive" => 1));
        $em->flush();
        
        if (count($parkinglots) == 0) {
            $this->redirect("admin/error");
        }
        /* @var $parkinglot Parkinglot */    
        $parkinglot = $parkinglots[0];
        
        $step3 = $this->loadFromSession("step_3");
        
        if ($step3 == false) {
            $arg = array();
            $arg["pkl"] = $parkinglot;
            $arg["vTypes"] = count($vtypes) > 0 ? $vtypes : array();
            $arg["error"] = true;
            $arg["errorMsg"] = "La Informacion ingresada no es valida";
            $this->loadView(self::$name . DS . "step_3", $arg);
            exit();
        }
        
        try {

            /* @var $layout Layout */
            foreach ($parkinglot->getLayouts() as $layout) {
                foreach ($layout->getLayoutPositions() as $position) {
                    $em->remove($position);
                }
                $em->remove($layout);
            }
            
            $em->flush();
            
            $this->generateLayout($parkinglot, $step3);
            $em->merge($parkinglot);
            $em->flush();
            
            $this->deleteFromSession("step_3");
            $this->deleteFromSession("currentStep");
            
            $this->redirect(self::$name . "/all");
        } catch (Exception $ex) {
            $arg = array();
            $arg["pkl"] = $parkinglot;
            $arg["vTypes"] = count($vtypes) > 0 ? $vtypes : array();
            $arg["error"] = true;
            $arg["errorMsg"] = $ex->getMessage();
            $this->loadView(self::$name . DS . "step_3", $arg);
        }
    }
    
    public function editClient($id) {
        $id = $this->filter($id);

        $name = $this->getInput(INPUT_POST, "name");
        $description = $this->getInput(INPUT_POST, "description");
        $address = $this->getInput(INPUT_POST, "address");
        $isCovered = $this->getInput(INPUT_POST, "isCovered");
        $latMap = $this->getInput(INPUT_POST, "lat");
        $longMap = $this->getInput(INPUT_POST, "lng");
        $openTime = $this->getInput(INPUT_POST, "openTime");
        $closeTime = $this->getInput(INPUT_POST, "closeTime");
        $cityId = $this->getInput(INPUT_POST, "city");

        $em = Ioc::getService("orm");

        $criteria = array("id" => $id, "isActive" => 1);
        $parkinglots = $em->getRepository("Parkinglot")->findBy($criteria);
        $countries = $em->getRepository("Country")->findAll();

        $city = $em->find("City", $cityId);

        if (count($parkinglots) == 0) {
            $this->redirect("admin/error");
        }

        /* @var $pkl Parkinglot */
        $pkl = $parkinglots[0];
        $pkl->setName($name);
        $pkl->setDescription($description);
        $pkl->setAddress($address);
        $pkl->setIsCovered($isCovered);
        $pkl->setLatMap($latMap);
        $pkl->setLongMap($longMap);
        $pkl->setOpenTime($openTime);
        $pkl->setCloseTIme($closeTime);
        $pkl->setCity($city);

        if ($this->validate($pkl)) {
            try {
                $em->merge($pkl);
                $em->flush();
                $this->redirect(self::$name . DS . "view");
            } catch (Exception $ex) {
                $arg = array();
                $arg["pkl"] = $pkl;
                $arg["countries"] = count($countries) > 0 ? $countries : array();
                $arg["error"] = true;
                $arg["errorMsg"] = $ex->getMessage();
                $this->loadView(self::$rootFolder . DS . "edit_client", $arg);
            }
        } else {
            $arg = array();
            $arg["pkl"] = $pkl;
            $arg["countries"] = count($countries) > 0 ? $countries : array();
            $arg["error"] = true;
            $arg["errorMsg"] = "La informacion ingresada no es valida";
            $this->loadView(self::$rootFolder . DS . "edit_client", $arg);
        }
    }
    
    public function del() {

        $id = $this->getInput(INPUT_POST, "id");

        try {
            $em = Ioc::getService("orm");
            /* @var $usr User */
            $usr = $em->find("Parkinglot", $id);
            $usr->setIsActive(false);
            $em->merge($usr);
            $em->flush();
        } catch (Exception $ex) {
            
        }
    }

    public function all($currentPage = 1, $search = "") {

        $currentPage = $this->filter($currentPage);
        $search = $this->filter($search);

        $val = $this->getInput(INPUT_POST, "q");
        if ($val == NULL) {
            $q = $search;
        } else {
            $q = $val;
        }

        try {
            $pageSize = 10;
            $em = Ioc::getService("orm");

            $dql = "SELECT pkl FROM Parkinglot pkl WHERE pkl.isActive = 1 AND pkl.name LIKE :q1";
            $query = $em->createQuery($dql);
            $query->setParameter("q1", "%" . $q . "%");

            $paginator = new \Doctrine\ORM\Tools\Pagination\Paginator($query);

            $totalItems = count($paginator);
            $pagesCount = ceil($totalItems / $pageSize);

            $paginator
                    ->getQuery()
                    ->setFirstResult($pageSize * ($currentPage - 1))
                    ->setMaxResults($pageSize);


            $prev = "/" . Ioc::getService("domain") . "/" . self::$name . "/all/" . ($currentPage - 1) . "/" . $q;
            $next = "/" . Ioc::getService("domain") . "/" . self::$name . "/all/" . ($currentPage + 1) . "/" . $q;

            $arg = array();
            $arg["error"] = false;
            $arg["errorMsg"] = "";
            $arg["parkinglots"] = $paginator;
            $arg["pagesCount"] = $pagesCount;
            $arg["currentPage"] = $currentPage;
            $arg["prev"] = $prev;
            $arg["next"] = $next;
            $arg["q"] = $q;
            $this->loadView(self::$rootFolder . DS . "list", $arg);
        } catch (Exception $ex) {
            $arg = array();
            $arg["error"] = true;
            $arg["errorMsg"] = $ex->getMessage();
            $arg["parkinglots"] = array();
            $arg["pagesCount"] = 1;
            $arg["currentPage"] = 1;
            $arg["prev"] = "";
            $arg["next"] = "";
            $arg["q"] = "";
            $this->loadView(self::$rootFolder . DS . "list", $arg);
        }
    }

    public function upd($id) {
        try {
            $id = $this->filter($id);
            $em = Ioc::getService("orm");

            /* @var $parkinglot Parkinglot */
            $parkinglots = $em->getRepository("Parkinglot")->findBy(array("id" => $id, "isActive" => 1));
            $countries = $em->getRepository("Country")->findAll();

            $em->flush();

            $arg = array();
            $arg["pkl"] = count($parkinglots) > 0 ? $parkinglots[0] : null;
            $arg["countries"] = count($countries) > 0 ? $countries : array();
            $arg["error"] = false;
            $arg["errorMsg"] = "";
            $this->loadView(self::$rootFolder . DS . "step_2", $arg);
        } catch (Exception $ex) {
            $arg = array();
            $arg["pkl"] = NULL;
            $arg["countries"] = array();
            $arg["error"] = true;
            $arg["errorMsg"] = $ex->getMessage();
            $this->loadView(self::$rootFolder . DS . "step_2", $arg);
        }
    }

    public function updLayout($id) {
        try {
            $id = $this->filter($id);
            $em = Ioc::getService("orm");

            /* @var $parkinglot Parkinglot */
            $parkinglots = $em->getRepository("Parkinglot")->findBy(array("id" => $id, "isActive" => 1));
            $vtypes = $em->getRepository("VehicleType")->findBy(array("isActive" => 1));
            $em->flush();

            $arg = array();
            $arg["pkl"] = count($parkinglots) > 0 ? $parkinglots[0] : null;
            $arg["vTypes"] = count($vtypes) > 0 ? $vtypes : array();
            $arg["error"] = false;
            $arg["errorMsg"] = "";
            $this->loadView(self::$rootFolder . DS . "step_3", $arg);
        } catch (Exception $ex) {
            $arg = array();
            $arg["pkl"] = NULL;
            $arg["error"] = true;
            $arg["errorMsg"] = $ex->getMessage();
            $this->loadView(self::$rootFolder . DS . "step_3", $arg);
        }
    }
    
    public function updClient($id) {
        try {
            $id = $this->filter($id);
            $em = Ioc::getService("orm");

            /* @var $parkinglot Parkinglot */
            $parkinglots = $em->getRepository("Parkinglot")->findBy(array("id" => $id, "isActive" => 1));
            $countries = $em->getRepository("Country")->findAll();

            $em->flush();

            $arg = array();
            $arg["pkl"] = count($parkinglots) > 0 ? $parkinglots[0] : null;
            $arg["countries"] = count($countries) > 0 ? $countries : array();
            $arg["error"] = false;
            $arg["errorMsg"] = "";
            $this->loadView(self::$rootFolder . DS . "edit_client", $arg);
        } catch (Exception $ex) {
            $arg = array();
            $arg["pkl"] = NULL;
            $arg["countries"] = array();
            $arg["error"] = true;
            $arg["errorMsg"] = $ex->getMessage();
            $this->loadView(self::$rootFolder . DS . "edit_client", $arg);
        }
    }
    
    public function layout($id) {
        
        $id = $this->filter($id);
        $em = Ioc::getService("orm");
        
        $parkinglot = $em->find("Parkinglot", $id);
        
        if ($parkinglot == NULL) {
            $this->redirect(self::$name . "/error");
        }
        
        $arg = array();
        $arg["pkl"] = $parkinglot;
        $this->loadView(self::$rootFolder . DS . "layout", $arg);
    }

    public function view() {
        
        /* @var $parkinglot Parkinglot */
        $userId = $this->loadFromSession("userID");
        $parkinglot = self::getUserParkinglot($userId);
        
        if ($parkinglot == NULL) {
            $this->redirect("admin/error");
        }
        
        try {
            $em = Ioc::getService("orm");
            $countries = $em->getRepository("Country")->findAll();
            $em->flush();
            
            $arg = array();
            $arg["pkl"] = $parkinglot;
            $arg["countries"] = count($countries) > 0 ? $countries : array();
            $arg["error"] = false;
            $arg["errorMsg"] = "";
            $this->loadView(self::$rootFolder . DS . "view", $arg);
        } catch (Exception $ex) {
            $arg = array();
            $arg["pkl"] = NULL;
            $arg["countries"] = array();
            $arg["error"] = true;
            $arg["errorMsg"] = $ex->getMessage();
            $this->loadView(self::$rootFolder . DS . "view", $arg);
        }
        
        
    }
    
    public function map($id) {
        try {
            $id = $this->filter($id);
            $em = Ioc::getService("orm");

            /* @var $parkinglot Parkinglot */
            $parkinglots = $em->getRepository("Parkinglot")->findBy(array("id" => $id, "isActive" => 1));
            $em->flush();

            $arg = array();
            $arg["pkl"] = count($parkinglots) > 0 ? $parkinglots[0] : null;
            $arg["error"] = false;
            $arg["errorMsg"] = "";
            $this->loadView(self::$rootFolder . DS . "map", $arg);
        } catch (Exception $ex) {
            $arg = array();
            $arg["pkl"] = NULL;
            $arg["error"] = true;
            $arg["errorMsg"] = $ex->getMessage();
            $this->loadView(self::$rootFolder . DS . "map", $arg);
        }
    }
    
    public function capacity() {
        /* @var $parkinglot Parkinglot */
        $userId = $this->loadFromSession("userID");
        $parkinglot = self::getUserParkinglot($userId);
        
        if ($parkinglot == NULL) {
            $this->redirect("admin/error");
        } 
        
        $arg = array();
        $arg["pkl"] = $parkinglot;
        $this->loadView(self::$rootFolder . DS . "capacity", $arg);
    }
}
