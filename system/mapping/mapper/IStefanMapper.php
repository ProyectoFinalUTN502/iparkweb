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
interface IStefanMapper {
    public function persist($entity);
    public function update($entity);
    public function remove($entity);
    
    public function find($entityType, $id);
    public function findAll($criteria);
}
