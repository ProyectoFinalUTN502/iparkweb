<?php
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Vehicle
 * 
 * @Entity
 * @Table(name="vehicle")
 */
class Vehicle {
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
     * @var int
     * */
    private $currentVehicle;
    /**
     * @Column(type="integer") 
     * @var int
     * */
    private $isActive;
    
    /**
     * @ManyToOne(targetEntity="VehicleType", inversedBy="vehicles")
     * @JoinColumn(name="vehicle_type_id", referencedColumnName="id")
     */
    private $vehicleType;
    
    /**
     * @ManyToOne(targetEntity="Client", inversedBy="vehicles")
     * @JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;
    
    /**
     * @OneToMany(
     * targetEntity="VehicleParking", 
     * mappedBy="vehicle", 
     * cascade={"persist", "detach" , "merge"})
     */
    private $vehicleParkings;
    
    public function __construct() {
        $this->vehicleParkings = new ArrayCollection();
        $this->isActive = 1;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function isCurrentVehicle() {
        return $this->currentVehicle == 1 ? true : false;
    }

    public function isActive() {
        return $this->isActive == 1 ? true : false;
    }

    public function getVehicleType() {
        return $this->vehicleType;
    }

    public function getClient() {
        return $this->client;
    }

    public function getVehicleParkings() {
        return $this->vehicleParkings;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setCurrentVehicle($currentVehicle) {
        $this->currentVehicle = $currentVehicle ? 1 : 0;
    }

    public function setIsActive($isActive) {
        $this->isActive = $isActive ? 1 : 0;
    }

    public function setVehicleType(VehicleType $vehicleType) {
        $this->vehicleType = $vehicleType;
    }

    public function setClient(Client $client) {
        $this->client = $client;
    }

    public function addVehickeParking(VehicleParking $vp) {
        $this->vehicleParkings->add($vp);
    }

}
