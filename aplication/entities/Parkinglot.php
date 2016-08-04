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
    private $address;

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

    public function __toString() {
        return $this->ssid . "<hr>" .
        $this->name . "<hr>" .
        $this->description . "<hr>" .
        $this->address . "<hr>" .
        $this->latMap . "<hr>" .
        $this->longMap . "<hr>" .
        $this->getOpenTime() . "<hr>" .
        $this->getCloseTIme() . "<hr>" .
        $this->getCity()->getDescription();
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

    public function getAddress() {
        return $this->address;
    }

    public function getIsActive() {
        return $this->isActive == 1 ? true : false;
    }

    public function getIsCovered() {
        return $this->isCovered == 1 ? true : false;
    }

    public function getLatMap() {
        return $this->latMap;
    }

    public function getLongMap() {
        return $this->longMap;
    }

    public function getOpenTime() {
        return $this->openTime->format("H:i");
    }

    public function getCloseTIme() {
        return $this->closeTIme->format("H:i");
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

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setIsActive($state) {
        $this->isActive = $state ? 1 : 0;
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

    public function setOpenTime($openTime) {
//        $timeArray = explode(":" , $openTime);
//        $hour = $timeArray[0];
//        array_shift($timeArray);
//        $minute = $timeArray[0];
//        
//        $this->openTime = new DateTime();
//        $this->openTime->setTime($hour, $minute);
        
        $this->openTime = new DateTime($openTime);
    }

    public function setCloseTIme($closeTIme) {
        $this->closeTIme = new DateTime($closeTIme);
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function addLayout(Layout $l) {
        $this->layouts->add($l);
    }

    public function addPrice(Price $p) {
        $this->layouts->add($p);
    }

}
