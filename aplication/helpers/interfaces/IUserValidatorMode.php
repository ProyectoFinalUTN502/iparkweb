<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Stefan
 */
interface IUserValidatorMode {
    public function validate(User $usr);
    public function existingUser($userName);
    public function existingEmail($email);
}
