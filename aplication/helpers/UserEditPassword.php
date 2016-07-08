<?php

require_once APPPATH . DS . "helpers" . DS . "interfaces" . DS . "IUserValidatorMode.php";

class UserEditPassword implements IUserValidatorMode {
    public function validate(User $usr) {
        $result = true;
        $result = !Validator::minLength($usr->getPassword(), 6) ? false : $result;
        return $result;
    }
    
    public function existingUser($userName){}
    
    public function existingEmail($email){}
}
