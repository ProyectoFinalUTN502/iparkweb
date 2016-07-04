<?php

class RoleController extends StefanController {

    static $name = "role";
    static $rootFolder = "rol";

    public function listAll() {
        try {
            $em = Ioc::getService("orm");
            $rols = $em->getRepository("Rol")->findBy(array("isActive" => 1));
        } catch (Exception $ex) {
            $rols = array();
        }

        return $rols;
    }

    public function validate(Rol $rol) {

        $result = true;
        
        $result = Validator::isNull($rol->getName()) ? false : $result;
        $result = !Validator::lettersOnly($rol->getName()) ? false : $result;
        
        $result = empty($rol->getPermissions()) ? false : $result;
        return $result;
    }
    
    public function updatePermissions(Rol &$rol, $arrayGroup = array()) {

        try{
            $em = Ioc::getService("orm");

            $rol->cleanPermissions();
            for ($i = 0; $i < count($arrayGroup); $i++) {
                $group = $em->find("Group", $this->filter($arrayGroup[$i]));
                $permission = new Permission($rol, $group);
                $rol->addPermission($permission);
            }
        } catch (Exception $ex) {
            $rol->cleanPermissions();
        }
    }

    public function register() {
        $name = $this->getInput(INPUT_POST, "name");
        $groupsChecked = $this->getInput(INPUT_POST, "groups", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

        $rol = new Rol();
        $rol->setName($name);

        $em = Ioc::getService("orm");
        for ($i = 0; $i < count($groupsChecked); $i++) {
            $id = $this->filter($groupsChecked[$i]);

            /* @var $group Group */
            $group = $em->find("Group", $id);

            /* @var $permission Permission */
            $permission = new Permission();
            $permission->setRol($rol);
            $permission->setGroup($group);

            $rol->addPermission($permission);
        }

        $groups = $em->getRepository("Group")->findAll();
        if ($this->validate($rol)) {

            try {
                $em->persist($rol);
                $em->flush();
                $this->redirect(self::$name . "/all");
            } catch (Exception $ex) {
                $arg = array();
                $arg["error"] = true;
                $arg["errorMsg"] = $ex->getMessage();
                $arg["rol"] = null;
                $arg["groups"] = $groups;
                $this->loadView(self::$rootFolder . DS . "entity", $arg);
            }
        } else {

            $arg = array();
            $arg["error"] = true;
            $arg["errorMsg"] = "Controle la Informacion Ingresada";
            $arg["rol"] = null;
            $arg["groups"] = $groups;
            $this->loadView(self::$rootFolder . DS . "entity", $arg);
        }
    }

    public function edit($id) {
    
        $em = Ioc::getService("orm");
        $id = $this->filter($id);
        $name = $this->getInput(INPUT_POST, "name");
        $groupsChecked = $this->getInput(
                INPUT_POST, "groups", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY
        );

        /* @var $rol Rol */
        $rol = $em->find("Rol", $id);
        if($rol == null){
            $this->redirect("admin/error");
        }
        $groups = $em->getRepository("Group")->findAll();

        $newRol = new Rol();
        $newRol->setId($id);
        $newRol->setName($name);
        $this->updatePermissions($newRol, $groupsChecked);

        if ($this->validate($newRol)) {
            try {
                $rol->setName($name);
                foreach ($rol->getPermissions() as $p) {
                    $mp = $em->merge($p);
                    $em->remove($mp);
                }
                $em->flush();

                $this->updatePermissions($rol, $groupsChecked);
                $em->merge($rol);
                $em->flush();
                $this->redirect(self::$name . "/all");
            } catch (Exception $ex) {
                $arg = array();
                $arg["error"] = true;
                $arg["errorMsg"] = $ex->getMessage();
                $arg["rol"] = null;
                $arg["groups"] = $groups;
                $this->loadView(self::$rootFolder . DS . "entity", $arg);
            }
        } else {
            $arg = array();
            $arg["error"] = true;
            $arg["errorMsg"] = "La Informacion Ingresada no es valida";
            $arg["rol"] = $newRol;
            $arg["groups"] = $groups;
            $this->loadView(self::$rootFolder . DS . "entity", $arg);
        }

    }

    public function del() {

        $id = $this->getInput(INPUT_POST, "id");

        try {
            $em = Ioc::getService("orm");
            
            /* @var $rol Rol */
            $rol = $em->find("Rol", $id);
            if($rol != null){
                $rol->setIsActive(false);
                $em->merge($rol);
                $em->flush();
            }
        } catch (Exception $ex) {}
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

            $dql = "SELECT rls FROM Rol rls WHERE rls.isActive = 1 AND rls.name LIKE :q";
            $query = $em->createQuery($dql);
            $query->setParameter("q", "%" . $q . "%");
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
            $arg["roles"] = $paginator;
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
            $arg["roles"] = array();
            $arg["pagesCount"] = 1;
            $arg["currentPage"] = 1;
            $arg["prev"] = "";
            $arg["next"] = "";
            $arg["q"] = "";
            $this->loadView(self::$rootFolder . DS . "list", $arg);
        }
    }

    public function add() {

        try {
            $em = Ioc::getService("orm");
            $groups = $em->getRepository("Group")->findAll();
        } catch (Exception $ex) {
            $groups = array();
        }

        $arg = array();
        $arg["error"] = false;
        $arg["errorMsg"] = "";
        $arg["rol"] = null;
        $arg["groups"] = $groups;

        $this->loadView(self::$rootFolder . DS . "entity", $arg);
    }

    public function upd($id) {
        
        try {
            $id = $this->filter($id);
            $em = Ioc::getService("orm");
            
            /* @var $rol Rol */
            $roles = $em->getRepository("Rol")->findBy(array("id" => $id, "isActive" => 1));
            $rol = count($roles) > 0 ? $roles[0] : null;
            $groups = $em->getRepository("Group")->findAll();
            $em->flush();

            $arg = array();
            $arg["error"] = false;
            $arg["errorMsg"] = "";
            $arg["rol"] = $rol;
            $arg["groups"] = $groups;
        } catch (Exception $ex) {
            $arg = array();
            $arg["error"] = true;
            $arg["errorMsg"] = $ex->getMessage();
            $arg["rol"] = null;
            $arg["groups"] = array();
        } finally {
            $this->loadView(self::$rootFolder . DS . "entity", $arg);
        }
    }

}
