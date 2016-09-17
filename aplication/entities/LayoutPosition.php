<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="layout_position")
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="state", type="string")
 * @DiscriminatorMap({
 *  "LIBRE" = "FreeLayoutPosition", 
 *  "RESERVADA" = "BookedLayoutPosition", 
 *  "NO DISPONIBLE" = "UnavailableLayoutPosition"
 * })
 */
abstract class LayoutPosition {
    
    /**
     * @Id 
     * @Column(type="integer") 
     * @GeneratedValue 
     * @var int
     * */
    private $id;
    /**
     * @Column(type="integer") 
     * @var int
     */
    private $xPoint;
    /**
     * @Column(type="integer") 
     * @var int
     */
    private $yPoint;
    /**
     * @Column(type="integer") 
     * @var int
     */
    private $valid;
    /**
     * @Column(type="integer") 
     * @var int
     */
    private $circulationValue;
    /**
     * @Column(type="integer") 
     * @var int
     */
    private $din;
    /**
     * @Column(type="integer") 
     * @var int
     */
    private $dout;
    /**
     * @Column(type="integer") 
     * @var int
     */
    private $rIn;
    /**
     * @Column(type="integer") 
     * @var int
     */
    private $rOut;
    
    /**
     * @ManyToOne(targetEntity="Layout", inversedBy="layoutPositions")
     * @JoinColumn(name="layout_id", referencedColumnName="id")
     */
    private $layout;
    /**
     * @ManyToOne(targetEntity="VehicleType", inversedBy="layoutPositions")
     * @JoinColumn(name="vehicle_type_id", referencedColumnName="id")
     */
    private $vehicleType;
    
    /**
     * @OneToMany(
     * targetEntity="VehicleParking", 
     * mappedBy="layoutPosition", 
     * cascade={"persist", "detach" , "merge"})
     */
    private $vehicleParkings;
    
    
    public function __construct() {
        $this->layout = null;
        $this->vehicleType = null;
        $this->vehicleParkings = new ArrayCollection();
    }
    
    public function __toString() {
        $result = $this->xPoint . "<br>" . 
                $this->yPoint . "<br>" . 
                $this->valid . "<br>" .
                $this->circulationValue . "<br>";
        
        if($this->vehicleType == null) {
            $result .= "Sin Vehiculo<br>";
        } else {
            $result .= $this->vehicleType->getName() . "<br>";
        }
        
        return $result;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getXPoint() {
        return $this->xPoint;
    }

    public function getYPoint() {
        return $this->yPoint;
    }

    public function getValid() {
        return $this->valid;
    }

    public function getCirculationValue() {
        return $this->circulationValue;
    }

    public function getLayout() {
        return $this->layout;
    }

    public function getVehicleType() {
        return $this->vehicleType;
    }

    public function getVehicleParkings() {
        return $this->vehicleParkings;
    }
    
    public function getIn() {
        return $this->din;
    }

    public function getOut() {
        return $this->dout;
    }

    public function getRIn() {
        return $this->rIn;
    }

    public function getROut() {
        return $this->rOut;
    }

    public function isValid() {
        return $this->valid == 1 ? true : false;
    }
    
    public function isIn() {
        return $this->din == 1 ? true : false;
    }
    
    public function isOut() {
        return $this->dout == 1 ? true : false;
    }
    
    public function isRampIn() {
        return $this->rIn == 1 ? true : false;
    }
    
    public function isRampOut() {
        return $this->rOut == 1 ? true : false;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setXPoint($xPoint) {
        $this->xPoint = $xPoint;
    }

    public function setYPoint($yPoint) {
        $this->yPoint = $yPoint;
    }

    public function setValid($valid) {
        $this->valid = $valid;
    }

    public function setCirculationValue($circulationValue) {
        $this->circulationValue = $circulationValue;
    }

    public function setLayout(Layout $layout) {
        $this->layout = $layout;
    }

    public function setVehicleType(VehicleType $vehicleType) {
        $this->vehicleType = $vehicleType;
    }
    
    public function setIn($in) {
        $this->din = $in;
    }

    public function setOut($out) {
        $this->dout = $out;
    }

    public function setRIn($rIn) {
        $this->rIn = $rIn;
    }

    public function setROut($rOut) {
        $this->rOut = $rOut;
    }
    
    public function addVehicleParkings(VehicleParking $vp) {
        $this->vehicleParkings->add($vp);
    }
}

/** @Entity **/
class FreeLayoutPosition extends LayoutPosition {
    public function getState(){
        return "LIBRE";
    }
}

/** @Entity **/
class BookedLayoutPosition extends LayoutPosition {
    public function getState(){
        return "RESERVADA";
    }
}

/** @Entity **/
class UnavailableLayoutPosition extends LayoutPosition {
    public function getState(){
        return "NO DISPONIBLE";
    }
    
}
