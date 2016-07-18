<?php
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
    
    function getId() {
        return $this->id;
    }

    function getDescription() {
        return $this->description;
    }

    function getState() {
        return $this->state;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setState($state) {
        $this->state = $state;
    }




}