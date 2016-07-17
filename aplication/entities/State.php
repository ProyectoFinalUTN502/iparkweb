<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * State
 * 
 * @Entity
 * @Table(name="state")
 */
class State {
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
     * @ManyToOne(targetEntity="Province", inversedBy="states")
     * @JoinColumn(name="province_id", referencedColumnName="id")
     */
    private $province;
    
    /**
     * @OneToMany(targetEntity="City", mappedBy="state", cascade={"persist", "detach" , "merge"})
     */
    private $cities;
    
    function __construct() {
        $this->cities = new ArrayCollection();
    }
    
    function getId() {
        return $this->id;
    }

    function getDescription() {
        return $this->description;
    }

    function getProvince() {
        return $this->province;
    }

    function getCities() {
        return $this->cities;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setProvince($province) {
        $this->province = $province;
    }

    function setCities($cities) {
        $this->cities = $cities;
    }


}