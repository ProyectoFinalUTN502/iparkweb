<?php
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Client
 * 
 * @Entity
 * @Table(name="client")
 */
class Client {
    
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
    private $key;
    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $macAddress;
    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $email;
    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $password;
    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $name;
    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $lastName;
    /**
     * @Column(type="integer") 
     * @var int
     * */
    private $isActive;
    
    
    /**
     * @OneToMany(
     * targetEntity="Profile", 
     * mappedBy="client", 
     * cascade={"persist", "detach" , "merge"})
     */
    private $profiles;
    /**
     * @OneToMany(
     * targetEntity="Vehicle", 
     * mappedBy="client", 
     * cascade={"persist", "detach" , "merge"})
     */
    private $vehicles;
    
    public function __construct() {
        $this->profiles = new ArrayCollection();
        $this->vehicles = new ArrayCollection();
        $this->isActive = 1;
    }
    
    public function __toString() {
        $result = $this->id . "<br>" . 
                $this->key . "<br>" . 
                $this->macAddress . "<br>" . 
                $this->email . "<br>" . 
                $this->name . "<br>" . 
                $this->lastName . "<hr>";
        
        return $result;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getKey() {
        return $this->key;
    }

    public function getMacAddress() {
        return $this->macAddress;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getName() {
        return $this->name;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getProfiles() {
        return $this->profiles;
    }
    
    public function getVehicles() {
        return $this->vehicles;
    }
    
    public function isActive() {
        return $this->isActive == 1 ? true : false;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setKey($key) {
        $this->key = $key;
    }

    public function setMacAddress($macAddress) {
        $this->macAddress = $macAddress;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function setIsActive($isActive) {
        $this->isActive = $isActive ? 1 : 0 ;
    }

    public function addProfile(Profile $p) {
        $this->profiles->add($p);
    }

    public function addVehicle(Vehicle $v) {
        $this->vehicles->add($v);
    }
}
