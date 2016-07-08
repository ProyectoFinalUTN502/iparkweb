<?php

class UserController extends StefanController {

    static $name = "user";
    static $rootFolder = "user";

    // <editor-fold defaultstate="collapsed" desc="PROCESOS">
    public function remoteDuplicateUser(){
        $userName = $this->getInput(INPUT_POST, "user");
        $validator = new UserNew();
        echo $validator->existingUser($userName) ? "true" : "false";
    }
    
    public function remoteDuplicateEmail(){
        $email = $this->getInput(INPUT_POST, "email");
        $validator = new UserNew();
        echo $validator->existingEmail($email) ? "true" : "false";
    }
    
    public function validate(User $usr, IUserValidatorMode $mode) {

        return $mode->validate($usr);
    }

    public function register() {
        $user = $this->getInput(INPUT_POST, "user");
        $password = $this->getInput(INPUT_POST, "password");
        $repassword = $this->getInput(INPUT_POST, "repassword");
        $name = $this->getInput(INPUT_POST, "name");
        $lastName = $this->getInput(INPUT_POST, "lastName");
        $email = $this->getInput(INPUT_POST, "email");
        $rolId = $this->getInput(INPUT_POST, "rol");
        
        $em = Ioc::getService("orm");
        $roles = $em->getRepository("Rol")->findBy(array("isActive" => 1));
        
        if($password == $repassword){
            /* @var $rol Rol */
            $rol = $em->find("Rol", $rolId);
            
            $usr = new User();
            $usr->setUser($user);
            $usr->setPassword(Security::generateHash($password, new SHA256()));
            $usr->setName($name);
            $usr->setLastName($lastName);
            $usr->setEmail($email);
            $usr->setRole($rol);
            
            if($this->validate($usr, new UserNew())){
                try {
                $em = Ioc::getService("orm");
                $em->persist($usr);
                $em->flush();
                $this->redirect(self::$name . "/all");
            } catch (Exception $ex) {
                $arg = array();
                $arg["error"] = true;
                $arg["errorMsg"] = $ex->getMessage();
                $arg["usr"] = null;
                $arg["roles"] = $roles;
                $this->loadView(self::$rootFolder . DS . "entity", $arg);
            }
            } else {
                // ERROR DE VALIDACION
                $arg = array();
                $arg["error"] = true;
                $arg["errorMsg"] = "La informacion ingresada no es valida";
                $arg["roles"] = $roles;
                $arg["usr"] = null;
                $this->loadView(self::$rootFolder . DS . "entity", $arg);
            }
            
        } else {
            // LOS PASSWORDS, NO CONCUERDAN
            $arg = array();
            $arg["error"] = true;
            $arg["errorMsg"] = "Las contrase&ntilde;as debe coincidir";
            $arg["roles"] = $roles;
            $arg["usr"] = null;
            $this->loadView(self::$rootFolder . DS . "entity", $arg);
        }
    }

    public function edit($id) {
        $id = $this->filter($id);
                
        $name = $this->getInput(INPUT_POST, "name");
        $lastName = $this->getInput(INPUT_POST, "lastName");
        $rolId = $this->getInput(INPUT_POST, "rol");

        /* @var $rol Rol */
        $em = Ioc::getService("orm");
        $rol = $em->find("Rol", $rolId);
        $criteria = array("isActive" => 1);
        $roles = $em->getRepository("Rol")->findBy($criteria);
        
        /* @var $usr User */
        $criteria = array("id" => $id, "isActive" => 1);
        $users = $em->getRepository("User")->findBy($criteria);
        
        if(count($users)== 0){
            $this->redirect("admin/error");
        }
        
        $usr = $users[0];
        $usr->setName($name);
        $usr->setLastName($lastName);
        $usr->setRole($rol);

        if ($this->validate($usr, new UserEdit())) {
            try {
                $em->merge($usr);
                $em->flush();
                $this->redirect(self::$name . "/all");
            } catch (Exception $ex) {
                $arg = array();
                $arg["error"] = true;
                $arg["errorMsg"] = $ex->getMessage();
                $arg["roles"] = $roles;
                $arg["usr"] = $usr;
                $this->loadView(self::$rootFolder . DS . "entity", $arg);
            }
        } else {
            $arg = array();
            $arg["error"] = true;
            $arg["errorMsg"] = "La informacion ingresada no es valida";
            $arg["roles"] = $roles;
            $arg["usr"] = $usr;
            $this->loadView(self::$rootFolder . DS . "entity", $arg);
        }
    }

    public function editPassword($id){
        $id = $this->filter($id);
                
        $password = $this->getInput(INPUT_POST, "password");
        $repassword = $this->getInput(INPUT_POST, "repassword");
        
        /* @var $rol Rol */
        $em = Ioc::getService("orm");
        
        /* @var $usr User */
        $criteria = array("id" => $id, "isActive" => 1);
        $users = $em->getRepository("User")->findBy($criteria);
        
        if(count($users)== 0){
            $this->redirect("admin/error");
        }
        
        $usr = $users[0];
        if($password != $repassword){
            $arg = array();
            $arg["error"] = true;
            $arg["errorMsg"] = "Las contrase&ntilde;as deben coincidir";
            $arg["usr"] = $usr;
            $this->loadView(self::$rootFolder . DS . "password", $arg);
            exit();
        }
        
        $usr->setPassword(Security::generateHash($password, new SHA256()));
        if ($this->validate($usr, new UserEditPassword())) {
            try {
                $em->merge($usr);
                $em->flush();
                $this->redirect(self::$name . "/all");
            } catch (Exception $ex) {
                $arg = array();
                $arg["error"] = true;
                $arg["errorMsg"] = $ex->getMessage();
                $arg["usr"] = $usr;
                $this->loadView(self::$rootFolder . DS . "password", $arg);
            }
        } else {
            $arg = array();
            $arg["error"] = true;
            $arg["errorMsg"] = "La informacion ingresada no es valida";
            $arg["usr"] = $usr;
            $this->loadView(self::$rootFolder . DS . "password", $arg);
        }
    }
    
    public function del() {

        $id = $this->getInput(INPUT_POST, "id");

        try {
            $em = Ioc::getService("orm");
            /* @var $usr User */
            $usr = $em->find("User", $id);
            $usr->setIsActive(false);
            $em->merge($usr);
            $em->flush();
        } catch (Exception $ex) {}
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

    public function updPassword($id){
        try {
            $id = $this->filter($id);
            $em = Ioc::getService("orm");
            
            /* @var $usr User */
            $criteria = array("id" => $id, "isActive" => 1);
            $users = $em->getRepository("User")->findBy($criteria);
            $usr = count($users) > 0 ? $users[0] : null;
            $em->flush();

            $arg = array();
            $arg["error"] = false;
            $arg["errorMsg"] = "";
            $arg["usr"] = $usr;
            $this->loadView(self::$rootFolder . DS . "password", $arg);
        } catch (Exception $ex) {
            $arg = array();
            $arg["error"] = true;
            $arg["errorMsg"] = $ex->getMessage();
            $arg["usr"] = null;
            $this->loadView(self::$rootFolder . DS . "password", $arg);
        }
    }
    // </editor-fold>
}
