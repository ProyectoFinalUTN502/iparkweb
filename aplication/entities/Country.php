<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Country
 * 
 * @Entity
 * @Table(name="country")
 */
class Country {
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
     * @OneToMany(targetEntity="Province", mappedBy="country", cascade={"persist", "detach" , "merge"})
     */
    private $provinces;
    
    function __construct() {
        $this->provinces = new ArrayCollection();
    }
    
    function getId() {
        return $this->id;
    }

    function getDescription() {
        return $this->description;
    }

    function getProvinces() {
        return $this->provinces;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setProvinces($provinces) {
        $this->provinces = $provinces;
    }
}