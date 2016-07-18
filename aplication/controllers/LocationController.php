<?php

class LocationController extends StefanController{
    
    public function test(){
        $em = Ioc::getService("orm");
        
        $countries = $em->getRepository("country")->findAll();
        
        /* @var $c Country */
        foreach($countries as $c){
            echo "<h3>Pais: " . $c->getDescription() . "</h3>";
            /* @var $p Province */
            foreach($c->getProvinces() as $p){
                echo "<h4>Provincia: " . $p->getDescription() . "</h4>";
                /* @var $s State */
                foreach($p->getStates() as $s){
                     echo "<h4>Partido: " . $s->getDescription() . "</h4>";
                     /* @var $ci City */
                     foreach($s->getCities() as $ci){
                       echo "<h4>Localidad: " . $ci->getDescription() . "</h4>";
                     }
                }
            }
        }
    }
}
