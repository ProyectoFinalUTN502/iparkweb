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
interface IControl {
    public function controlResult(StefanController $controller, Rol $r, Group $g);
    public function createResult(StefanController $controller, Rol $r, Group $g);
    public function updateResult(StefanController $controller, Rol $r, Group $g);
    public function deleteResult(StefanController $controller, Rol $r, Group $g);
    public function searchResult(StefanController $controller, Rol $r, Group $g);
}
