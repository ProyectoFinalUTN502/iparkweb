<?php

require_once SYSPATH . DS . "mapping" . DS . "mapper" . DS . "IStefanMapper.php";

class DoctrineMapper implements IStefanMapper {
   
    private $em = null;
    
    
    public function __construct() {
        $this->em = Ioc::getService("orm");
    }
    
    public function persist($entity){
        $this->em->persist($entity);
        $this->em->flush();
    }
    public function update($entity){
        $this->em->merge($entity);
        $this->em->flush();
    }
    public function remove($entity){
        $this->em->remove($entity);
        $this->em->flush();
    }
    
    public function find($entityType, $id){
        $entity = $this->em->find($entityType, $id);
        $this->em->flush();
        
        return $entity;
    }
    public function findAll($entityType, $criteria = array(), $order = array()){
        $entities = $this->em->getRepository($entityType)->findBy($criteria, $order);
        $this->em->flush();
        
        return $entities;
    }
    
}
