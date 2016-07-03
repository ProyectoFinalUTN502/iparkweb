<?php

class AdminController extends StefanController {

    static $name = "admin";
    
    public function login($error = false) {
        try{
            $arg = array();
            $arg["error"] = $error;
            $this->loadView("login", $arg);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function logout() {
        Session::close();
        $this->redirect(self::$name . "/login");
    }

    public function main(){
        try{
            $user = null;
            $userId = $this->loadFromSession("userID");
            if($userId != false){
                $em = Ioc::getService("orm");
                $user = $em->find("User", $userId);
                $em->flush();
                $arg = array();
                $arg["user"] = $user;
                $this->loadView("main", $arg);
            } else {
                
            }
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function error(){
        Session::close();
        $this->loadView("error");
    }
    
    public function authenticate(){
        $userName = $this->getInput(INPUT_POST, "user");
        $noHashPassword = $this->getInput(INPUT_POST, "password");
        $hashedPassword = Security::generateHash($noHashPassword, new SHA256());

        $criteria = array(
            "user" => $userName,
            "password" => $hashedPassword,
            "isActive" => 1
        );
        try {

            $em = Ioc::getService("orm");
            $users = $em->getRepository("User")->findBy($criteria);
            $em->flush();

            if (count($users) > 0) {
                /* @var $user User */
                $user = $users[0];
                
                $this->saveInSession("userID", $user->getId());
                $this->saveInSession("userUser", $user->getUser());
                
                $user->setLastIp(Security::getIP());
                $user->updateLogin();
                $user->updateLoginCount();

                $em->persist($user);
                $em->flush();

                $this->redirect(self::$name . "/main");
                
            } else {
                $this->login(true);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage() . "<hr>";
            exit();
        } 
    }
}
