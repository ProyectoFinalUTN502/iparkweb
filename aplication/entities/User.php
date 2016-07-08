<?php

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
    
    public function __construct() {
        $this->loginCount = 0;
        $this->isActive = 1;
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
        return $this->isActive;
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

    public function setIsActive($isActive) {
        $this->isActive = $isActive;
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


}
