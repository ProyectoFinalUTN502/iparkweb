<?php

/**
 * VehicleType
 *
 * @Entity 
 * @Table(name="vehicle_type")
 */
class VehicleType {
    
    /**
     * @Id 
     * @Column(type="integer") 
     * @GeneratedValue 
     * @var int
     * */
    private $id;
    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $name;
    
    /**
     * @Column(type="integer")
     * @var type 
     */
    private $isActive;
    
    public function __construct($name = "") {
        $this->name = $name;
        $this->isActive = 1;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getIsActive() {
        return $this->isActive == 1 ? true : false;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setIsActive($state) {
        $this->isActive = $state ? 1 : 0;
    }


}
