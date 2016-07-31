<?php

class VehicleTypeController extends StefanController {

    static $name = "vehicleType";
    static $rootFolder = "vehicleType";

    public function validate(VehicleType $vt) {

        $result = true;
        $result = Validator::isNull($vt->getName()) ? false : $result;
        $result = Validator::isNull($vt->getColor()) ? false : $result;
        $result = !Validator::lettersOnly($vt->getName()) ? false : $result;
        return $result;
    }

    public function register() {
        $name = $this->getInput(INPUT_POST, "name");
        $color = $this->getInput(INPUT_POST, "color");
        
        $vt = new VehicleType();
        $vt->setName($name);
        $vt->setColor($color);
        
        if ($this->validate($vt)) {

            try {
                $em = Ioc::getService("orm");
                $em->persist($vt);
                $em->flush();
                $this->redirect(self::$name . "/all");
            } catch (Exception $ex) {
                $arg = array();
                $arg["error"] = true;
                $arg["errorMsg"] = $ex->getMessage();
                $arg["vt"] = null;
                $this->loadView(self::$rootFolder . DS . "vt", $arg);
            }
        } else {
            $arg = array();
            $arg["error"] = true;
            $arg["errorMsg"] = "Controle la Informacion Ingresada";
            $arg["vt"] = null;
            $this->loadView(self::$rootFolder . DS . "vt", $arg);
        }
    }

    public function edit($id) {
        $id = $this->filter($id);
        $name = $this->getInput(INPUT_POST, "name");
        $color = $this->getInput(INPUT_POST, "color");

        $vt = new VehicleType();
        $vt->setId($id);
        $vt->setName($name);
        $vt->setColor($color);

        if ($this->validate($vt)) {

            try {
                $em = Ioc::getService("orm");
                $em->merge($vt);
                $em->flush();
                $this->redirect(self::$name . "/all");
            } catch (Exception $ex) {
                $arg = array();
                $arg["error"] = true;
                $arg["errorMsg"] = $ex->getMessage();
                $arg["vt"] = null;
                $this->loadView(self::$rootFolder . DS . "vt", $arg);
            }
        } else {
            $arg = array();
            $arg["error"] = true;
            $arg["errorMsg"] = "Controle la Informacion Ingresada";
            $arg["vt"] = null;
            $this->loadView(self::$rootFolder . DS . "vt", $arg);
        }
    }

    public function del() {

        $id = $this->getInput(INPUT_POST, "id");

        try {
            $em = Ioc::getService("orm");
            /* @var $vt VehicleType */
            $vt = $em->find("VehicleType", $id);
            $vt->setIsActive(false);
            $em->merge($vt);
            $em->flush();
        } catch (Exception $ex) {
            
        }
    }
    
    public function all($currentPage = 1, $search = "") {
        
        $currentPage = $this->filter($currentPage);
        $search = $this->filter($search);
        
        $val = $this->getInput(INPUT_POST, "q");
        if($val == NULL){
            $q = $search;
        } else {
            $q = $val;
        }

        try
        {
            $pageSize = 10;
            $em = Ioc::getService("orm");

            $dql = "SELECT vts FROM VehicleType vts WHERE vts.isActive = 1 AND vts.name LIKE :q";
            $query = $em->createQuery($dql);
            $query->setParameter("q","%" . $q . "%");
            $paginator = new \Doctrine\ORM\Tools\Pagination\Paginator($query);

            $totalItems = count($paginator);
            $pagesCount = ceil($totalItems / $pageSize);

            $paginator
                    ->getQuery()
                    ->setFirstResult($pageSize * ($currentPage - 1)) 
                    ->setMaxResults($pageSize); 
            
            
            $prev = "/" . Ioc::getService("domain") . "/" . self::$name . "/all/" . ($currentPage - 1) . "/" . $q;
            $next = "/" . Ioc::getService("domain") . "/" . self::$name . "/all/" . ($currentPage + 1). "/" . $q;
            
            $arg = array();
            $arg["error"] = false;
            $arg["errorMsg"] = "";
            $arg["vTypes"] = $paginator;
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
            $arg["vTypes"] = array();
            $arg["pagesCount"] = 1;
            $arg["currentPage"] = 1;
            $arg["prev"] = "";
            $arg["next"] = "";
            $arg["q"] = "";
            $this->loadView(self::$rootFolder . DS . "list", $arg);
        }
    }

    public function add() {
        $arg = array();
        $arg["error"] = false;
        $arg["errorMsg"] = "";
        $arg["vt"] = null;
        $this->loadView(self::$rootFolder . DS . "vt", $arg);
    }

    public function upd($id) {
        try {
            $id = $this->filter($id);
            $em = Ioc::getService("orm");
            /* @var $vt VehicleType */
            $vtypes = $em->getRepository("VehicleTYpe")->findBy(array("id" => $id, "isActive" => 1));
            $vt = count($vtypes) > 0 ? $vtypes[0] : null;
            $em->flush();

            $arg = array();
            $arg["error"] = false;
            $arg["errorMsg"] = "";
            $arg["vt"] = $vt;
            $this->loadView(self::$rootFolder . DS . "vt", $arg);
        } catch (Exception $ex) {
            $arg = array();
            $arg["error"] = true;
            $arg["errorMsg"] = $ex->getMessage();
            $arg["vt"] = null;
            $this->loadView(self::$rootFolder . DS . "vt", $arg);
        }
    }

}
