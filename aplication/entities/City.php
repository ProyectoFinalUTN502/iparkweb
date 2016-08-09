<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * City
 * 
 * @Entity
 * @Table(name="city")
 */
class City {

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
     * @ManyToOne(targetEntity="State", inversedBy="cities")
     * @JoinColumn(name="state_id", referencedColumnName="id")
     */
    private $state;

    /**
     * @OneToMany(targetEntity="Parkinglot", mappedBy="city", cascade={"persist", "detach" , "merge"})
     */
    private $parkinglots;

    public function __construct() {
        $this->parkinglots = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getState() {
        return $this->state;
    }

    public function getParkinglots() {
        return $this->parkinglots;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setState($state) {
        $this->state = $state;
    }

    public function addParkinglot(Parkinglot $p) {
        $this->parkinglots->add($p);
    }

}
