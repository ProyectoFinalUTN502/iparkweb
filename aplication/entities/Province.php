<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Province
 * 
 * @Entity
 * @Table(name="province")
 */
class Province {
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
    private $description;
    
    /**
     * @ManyToOne(targetEntity="Country", inversedBy="provinces")
     * @JoinColumn(name="country_id", referencedColumnName="id")
     */
    private $country;
    
    /**
     * @OneToMany(targetEntity="State", mappedBy="province", cascade={"persist", "detach" , "merge"})
     */
    private $states;
    
    function __construct() {
        $this->states = new ArrayCollection();
    }
    
    function getId() {
        return $this->id;
    }

    function getDescription() {
        return $this->description;
    }

    function getCountry() {
        return $this->country;
    }

    function getStates() {
        return $this->states;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setCountry($country) {
        $this->country = $country;
    }

    function setStates($states) {
        $this->states = $states;
    }



    
}