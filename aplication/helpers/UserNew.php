<?php

require_once APPPATH . DS . "helpers" . DS . "interfaces" . DS . "IUserValidatorMode.php";

class UserNew implements IUserValidatorMode {
    public function validate(User $usr) {
        $result = true;
        $result = Validator::isNull($usr->getUser()) ? false : $result;
        $result = !Validator::minLength($usr->getPassword(), 6) ? false : $result;
        $result = Validator::isNull($usr->getName()) ? false : $result;
        $result = Validator::isNull($usr->getLastName()) ? false : $result;
        $result = !Validator::emailValidation($usr->getEmail()) ? false : $result;
        $result = $usr->getRol() == null ? false : $result;
        $result = !$this->existingUser($usr->getUser()) ? false : $result;
        $result = !$this->existingEmail($usr->getEmail()) ? false : $result;
        return $result;
    }
    
    public function existingUser($userName){
        $result = false;
        
        try{
            $em = Ioc::getService("orm");
            $users = $em->getRepository("User")->findBy(array("user" => $userName, "isActive" => 1));
            if(count($users) == 0){
                $result = true;
            }
        } catch (Exception $ex) {
            $result = false;
        }
        
        return $result;
    }
    
    public function existingEmail($email){
        $result = false;
        
        try{
            $em = Ioc::getService("orm");
            $users = $em->getRepository("User")->findBy(array("email" => $email, "isActive" => 1));
            if(count($users) == 0){
                $result = true;
            }
        } catch (Exception $ex) {
            $result = false;
        }
        
        return $result;
    }
}
