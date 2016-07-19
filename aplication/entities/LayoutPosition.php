<?php
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
     * @ManyToOne(targetEntity="Layout", inversedBy="layoutPositions")
     * @JoinColumn(name="layout_id", referencedColumnName="id")
     */
    private $layout;
    /**
     * @ManyToOne(targetEntity="VehicleType", inversedBy="layoutPositions")
     * @JoinColumn(name="layout_id", referencedColumnName="id")
     */
    private $vehicleType;
    
    //private $vehicleParking;
    
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

    public function setLayout($layout) {
        $this->layout = $layout;
    }

    public function setVehicleType($vehicleType) {
        $this->vehicleType = $vehicleType;
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
