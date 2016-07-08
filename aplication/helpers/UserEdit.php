<?php

require_once APPPATH . DS . "helpers" . DS . "interfaces" . DS . "IUserValidatorMode.php";

class UserEdit implements IUserValidatorMode {
    public function validate(User $usr) {
        $result = true;
        $result = Validator::isNull($usr->getName()) ? false : $result;
        $result = Validator::isNull($usr->getLastName()) ? false : $result;
        $result = !Validator::emailValidation($usr->getEmail()) ? false : $result;
        $result = $usr->getRol() == null ? false : $result;
        return $result;
    }
    
    public function existingUser($userName){}
    
    public function existingEmail($email){}
}
