<?php
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 * 
 * @Entity
 * @Table(name="user")
 */
class User {
    
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
    private $user;
    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $password;
    /**
     * @Column(type="integer")
     * @var type 
     */
    private $loginCount;
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
     * @Column(type="string", length=255)
     * @var string
     */
    private $email;
    /**
     * @Column(type="integer")
     * @var type 
     */
    private $isActive;
    /**
     * @Column(type="datetime")
     * @var Datetime
     */
    private $lastLogin;
    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $lastIp;
    /**
     * @ManyToOne(targetEntity="Rol", inversedBy="users")
     * @JoinColumn(name="rol_id", referencedColumnName="id")
     */
    private $rol;
    /**
     * @OneToMany(targetEntity="Parkinglot", mappedBy="user", cascade={"persist", "detach" , "merge"})
     */
    private $parkinglots;
    
    public function __construct() {
        $this->loginCount = 0;
        $this->isActive = 1;
        $this->parkinglots = new ArrayCollection();
    }
    
     public function __toString() {
        return $this->user . "  " . $this->password . " " . $this->name . " " . $this->lastName . " " . $this->email;
    }

    public function getId() {
        return $this->id;
    }

    public function getUser() {
        return $this->user;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getLoginCount() {
        return $this->loginCount;
    }

    public function getName() {
        return $this->name;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getIsActive() {
        return $this->isActive == 1 ? true : false;
    }

    public function getLastLogin() {
        return $this->lastLogin;
    }

    public function getLastIp() {
        return $this->lastIp;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getParkinglots() {
        return $this->parkinglots;
    }

        
    public function setId($id) {
        $this->id = $id;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function updateLoginCount() {
        $this->loginCount++;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setIsActive($state) {
        $this->isActive = $state ? 1 : 0;
    }

    public function updateLogin() {
        $this->lastLogin = new \DateTime("now");
    }

    public function setLastIp($lastIp) {
        $this->lastIp = $lastIp;
    }
    
    public function setRole(Rol $rol){
        $this->rol = $rol;
    }

    public function addParkingLot(ParkingLot $p){
        $this->parkinglots->add($p);
    }
    
    public function hastParkingLot(){
        return $this->parkinglots->isEmpty();
    }
    
   

}
