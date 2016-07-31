<?php
use Doctrine\Common\Collections\ArrayCollection;
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
     * @Column(type="string", length=255)
     * @var string
     */
    private $color;
    
    /**
     * @Column(type="integer")
     * @var type 
     */
    private $isActive;
    
    /**
     * @OneToMany(targetEntity="Price", mappedBy="vehicleType", cascade={"persist", "detach" , "merge"})
     */
    private $prices;
    /**
     * @OneToMany(targetEntity="LayoutPosition", mappedBy="vehicleType", cascade={"persist", "detach" , "merge"})
     */
    private $layoutPositions;
    
//    private $clientProfiles;
//    private $vehicles;
    
    public function __construct($name = "") {
        $this->name = $name;
        $this->isActive = 1;
        $this->prices = new ArrayCollection();
        $this->layoutPositions = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getColor() {
        return $this->color;
    }
        
    public function getIsActive() {
        return $this->isActive == 1 ? true : false;
    }
    
    public function getPrices() {
        return $this->prices;
    }

    public function getLayoutPositions(){
        return $this->layoutPositions;
    }
        
    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setColor($color) {
        $this->color = $color;
    }
        
    public function setIsActive($state) {
        $this->isActive = $state ? 1 : 0;
    }
    
    public function addPrice(Price $p){
        $this->prices->add($p);
    }
    
    public function addLayoutPosition(LayoutPosition $lp){
        $this->layoutPositions->add($lp);
    }
}
