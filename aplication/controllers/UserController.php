<?php

class UserController extends StefanController {

    static $name = "user";
    static $rootFolder = "user";

    // <editor-fold defaultstate="collapsed" desc="PROCESOS">
    public function validate(User $usr) {

//        $result = true;
//        $result = Validator::isNull($vt->getName()) ? false : $result;
//        $result = !Validator::lettersOnly($vt->getName()) ? false : $result;
//        return $result;
    }

    public function register() {
//        $name = $this->getInput(INPUT_POST, "name");
//
//        $vt = new VehicleType($name);
//        if ($this->validate($vt)) {
//
//            try {
//                $em = Ioc::getService("orm");
//                $em->persist($vt);
//                $em->flush();
//                $this->redirect(self::$name . "/all");
//            } catch (Exception $ex) {
//                $arg = array();
//                $arg["error"] = true;
//                $arg["errorMsg"] = $ex->getMessage();
//                $arg["vt"] = null;
//                $this->loadView(self::$rootFolder . DS . "vt", $arg);
//            }
//        } else {
//            $arg = array();
//            $arg["error"] = true;
//            $arg["errorMsg"] = "Controle la Informacion Ingresada";
//            $arg["vt"] = null;
//            $this->loadView(self::$rootFolder . DS . "vt", $arg);
//        }
    }

    public function edit($id) {
//        $name = $this->getInput(INPUT_POST, "name");
//        $id = $this->filter($id);
//
//        $vt = new VehicleType();
//        $vt->setId($id);
//        $vt->setName($name);
//
//        if ($this->validate($vt)) {
//
//            try {
//                $em = Ioc::getService("orm");
//                $em->merge($vt);
//                $em->flush();
//                $this->redirect(self::$name . "/all");
//            } catch (Exception $ex) {
//                $arg = array();
//                $arg["error"] = true;
//                $arg["errorMsg"] = $ex->getMessage();
//                $arg["vt"] = null;
//                $this->loadView(self::$rootFolder . DS . "vt", $arg);
//            }
//        } else {
//            $arg = array();
//            $arg["error"] = true;
//            $arg["errorMsg"] = "Controle la Informacion Ingresada";
//            $arg["vt"] = null;
//            $this->loadView(self::$rootFolder . DS . "vt", $arg);
//        }
    }

    public function del() {
//
//        $id = $this->getInput(INPUT_POST, "id");
//
//        try {
//            $em = Ioc::getService("orm");
//            /* @var $vt VehicleType */
//            $vt = $em->find("VehicleType", $id);
//            $vt->setIsActive(false);
//            $em->merge($vt);
//            $em->flush();
//        } catch (Exception $ex) {
//            
//        }
    }

    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="VISTAS">
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
            
            $dql = "SELECT usr FROM User usr WHERE usr.isActive = 1 AND (usr.user LIKE :q1 OR usr.name LIKE :q2 OR usr.email LIKE :q3)";
            $query = $em->createQuery($dql);
            $query->setParameter("q1", "%" . $q . "%");
            $query->setParameter("q2", "%" . $q . "%");
            $query->setParameter("q3", "%" . $q . "%");
            
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
            $arg["users"] = $paginator;
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
            $arg["users"] = array();
            $arg["pagesCount"] = 1;
            $arg["currentPage"] = 1;
            $arg["prev"] = "";
            $arg["next"] = "";
            $arg["q"] = "";
            $this->loadView(self::$rootFolder . DS . "list", $arg);
        }
    }

    public function add() {
        
        $em = Ioc::getService("orm");
        $roles = $em->getRepository("Rol")->findBy(array("isActive" => 1));
        
        $arg = array();
        $arg["error"] = false;
        $arg["errorMsg"] = "";
        $arg["usr"] = null;
        $arg["roles"] = $roles;
        $this->loadView(self::$rootFolder . DS . "entity", $arg);
    }

    public function upd($id) {
        
        try {
            $id = $this->filter($id);
            $em = Ioc::getService("orm");
            
            /* @var $usr User */
            $users = $em->getRepository("User")->findBy(array("id" => $id, "isActive" => 1));
            $usr = count($users) > 0 ? $users[0] : null;
            $roles = $em->getRepository("Rol")->findBy(array("isActive" => 1));
            $em->flush();

            $arg = array();
            $arg["error"] = false;
            $arg["errorMsg"] = "";
            $arg["usr"] = $usr;
            $arg["roles"] = $roles;
            $this->loadView(self::$rootFolder . DS . "entity", $arg);
        } catch (Exception $ex) {
            $arg = array();
            $arg["error"] = true;
            $arg["errorMsg"] = $ex->getMessage();
            $arg["usr"] = null;
            $arg["roles"] = array();
            $this->loadView(self::$rootFolder . DS . "entity", $arg);
        }
    }

    // </editor-fold>
}
