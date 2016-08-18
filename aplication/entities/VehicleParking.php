<?php

/**
 * VehicleParking
 *
 * @Entity
 * @Table(name="vehicle_parking")
 */
class VehicleParking {
    /**
     * @Id 
     * @Column(type="integer") 
     * @GeneratedValue 
     * @var int
     * */
    private $id;
    /**
     * @Column(type="datetime")
     * @var Datetime
     */
    private $creationDate;
    
    /**
     * @ManyToOne(targetEntity="Vehicle", inversedBy="vehicleParkings")
     * @JoinColumn(name="vehicle_id", referencedColumnName="id")
     */
    private $vehicle;
    /**
     * @ManyToOne(targetEntity="LayoutPosition", inversedBy="vehicleParkings")
     * @JoinColumn(name="layout_position_id", referencedColumnName="id")
     */
    private $layoutPosition;
    
    public function __construct() {
        $this->creationDate = new Date("now");
    }
    
    public function getId() {
        return $this->id;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function getVehicle() {
        return $this->vehicle;
    }

    public function getLayoutPosition() {
        return $this->layoutPosition;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setCreationDate(Datetime $creationDate) {
        $this->creationDate = $creationDate;
    }

    public function setVehicle(Vehicle $vehicle) {
        $this->vehicle = $vehicle;
    }

    public function setLayoutPosition(LayoutPosition $layoutPosition) {
        $this->layoutPosition = $layoutPosition;
    }


}
