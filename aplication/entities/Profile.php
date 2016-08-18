<?php

/**
 * Profile
 * 
 * @Entity
 * @Table(name="client_profile")
 */
class Profile {
    
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
     * */
    private $range;
    /**
     * @Column(type="decimal")
     * @var string
     */
    private $maxPrice;
    /**
     * @Column(type="integer") 
     * @var int
     * */
    private $is24;
    /**
     * @Column(type="integer") 
     * @var int
     * */
    private $isCovered;
    
    /**
     * @ManyToOne(targetEntity="Client", inversedBy="profiles")
     * @JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;
    
    public function __construct() {
        $this->is24 = 0;
        $this->isCovered = 0;
    }
    
    public function __toString() {
        $result = $this->id . "<br>" . 
                $this->range . "<br>" . 
                $this->maxPrice . "<br>" . 
                $this->is24 . "<br>" . 
                $this->isCovered . "<hr>";
        
        return $result;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getRange() {
        return $this->range;
    }

    public function getMaxPrice() {
        return $this->maxPrice;
    }

    public function getClient() {
        return $this->client;
    }
    
    public function is24() {
        return $this->is24 == 1 ? true : false;
    }

    public function isCovered() {
        return $this->isCovered == 1 ? true : false;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setRange($range) {
        $this->range = $range;
    }

    public function setMaxPrice($maxPrice) {
        $this->maxPrice = $maxPrice;
    }

    public function setIs24($is24) {
        $this->is24 = $is24 ? 1 : 0;
    }

    public function setIsCovered($isCovered) {
        $this->isCovered = $isCovered ? 1 : 0;
    }

    public function setClient(Client $c) {
        $this->client = $c;
    }

}
