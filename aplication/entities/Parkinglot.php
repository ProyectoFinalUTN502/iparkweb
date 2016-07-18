<?php
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Parkinglot
 * 
 * @Entity
 * @Table(name="parkinglot")
 */
class Parkinglot {
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
    private $ssid;
    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $name;
    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $description;
    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $addressName;
    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $addressNumber;
    /**
     * @Column(type="integer") 
     * @var int
     * */
    private $isActive;
    /**
     * @Column(type="integer") 
     * @var int
     * */
    private $isCovered;
    /**
     * @Column(type="decimal")
     * @var string
     */
    private $latMap;
    /**
     * @Column(type="decimal")
     * @var string
     */
    private $longMap;
    /**
     * @Column(type="time")
     * @var Datetime
     */
    private $openTime;
    /**
     * @Column(type="time")
     * @var Datetime
     */
    private $closeTIme;
    
    /**
     * @ManyToOne(targetEntity="User", inversedBy="parkinglots")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * @ManyToOne(targetEntity="City", inversedBy="parkinglots")
     * @JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $city;
    
    /**
     * @OneToMany(targetEntity="Layout", mappedBy="parkinglot", cascade={"persist", "detach" , "merge"})
     */
    private $layouts;
    /**
     * @OneToMany(targetEntity="Price", mappedBy="parkinglot", cascade={"persist", "detach" , "merge"})
     */
    private $prices;
    
    public function __construct() {
        $this->layouts = new ArrayCollection();
        $this->prices = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getSsid() {
        return $this->ssid;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getAddressName() {
        return $this->addressName;
    }

    public function getAddressNumber() {
        return $this->addressNumber;
    }

    public function getIsActive() {
        return $this->isActive;
    }

    public function getIsCovered() {
        return $this->isCovered;
    }

    public function getLatMap() {
        return $this->latMap;
    }

    public function getLongMap() {
        return $this->longMap;
    }

    public function getOpenTime() {
        return $this->openTime;
    }

    public function getCloseTIme() {
        return $this->closeTIme;
    }

    public function getUser() {
        return $this->user;
    }

    public function getCity() {
        return $this->city;
    }

    public function getLayouts() {
        return $this->layouts;
    }

    public function getPrices() {
        return $this->prices;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setSsid($ssid) {
        $this->ssid = $ssid;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setAddressName($addressName) {
        $this->addressName = $addressName;
    }

    public function setAddressNumber($addressNumber) {
        $this->addressNumber = $addressNumber;
    }

    public function setIsActive($isActive) {
        $this->isActive = $isActive;
    }

    public function setIsCovered($isCovered) {
        $this->isCovered = $isCovered;
    }

    public function setLatMap($latMap) {
        $this->latMap = $latMap;
    }

    public function setLongMap($longMap) {
        $this->longMap = $longMap;
    }

    public function setOpenTime(Datetime $openTime) {
        $this->openTime = $openTime;
    }

    public function setCloseTIme(Datetime $closeTIme) {
        $this->closeTIme = $closeTIme;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function addLayout(Layout $l){
        $this->layouts->add($l);
    }
    
    public function addPrice(Price $p){
        $this->layouts->add($p);
    }

}
