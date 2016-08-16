<?php
/**
 * Price
 * 
 * @Entity
 * @Table(name="price")
 */
class Price {
    /**
     * @Id 
     * @Column(type="integer") 
     * @GeneratedValue 
     * @var int
     */
    private $id;
    /**
     * @Column(type="decimal")
     * @var string
     */
    private $price;
    /**
     * @Column(type="integer") 
     * @var int
     * */
    private $isActive;
    
    /**
     * @ManyToOne(targetEntity="Parkinglot", inversedBy="prices")
     * @JoinColumn(name="parkinglot_id", referencedColumnName="id")
     */
    private $parkinglot;
    /**
     * @ManyToOne(targetEntity="VehicleType", inversedBy="prices")
     * @JoinColumn(name="vehicle_type_id", referencedColumnName="id")
     */
    private $vehicleType;
    
    public function __construct() {
        $this->isActive = 1;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getPrice() {
        return $this->price;
    }

    public function isActive() {
        return $this->isActive == 1 ? true : false;
    }

    public function getParkinglot() {
        return $this->parkinglot;
    }

    public function getVehicleType() {
        return $this->vehicleType;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setIsActive($isActive) {
        $this->isActive = $isActive;
    }

    public function setParkinglot(Parkinglot $parkinglot) {
        $this->parkinglot = $parkinglot;
    }

    public function setVehicleType(VehicleType $vehicleType) {
        $this->vehicleType = $vehicleType;
    }

}
