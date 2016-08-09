<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Layout
 * 
 * @Entity
 * @Table(name="layout")
 */
class Layout {

    /**
     * @Id 
     * @Column(type="integer") 
     * @GeneratedValue 
     * @var int
     */
    private $id;

    /**
     * @Column(type="integer") 
     * @var int
     */
    private $floor;

    /**
     * @Column(type="integer") 
     * @var int
     */
    private $maxRows;

    /**
     * @Column(type="integer") 
     * @var int
     */
    private $maxCols;

    /**
     * @ManyToOne(targetEntity="Parkinglot", inversedBy="layouts")
     * @JoinColumn(name="parkinglot_id", referencedColumnName="id")
     */
    private $parkinglot;

    /**
     * @OneToMany(targetEntity="LayoutPosition", mappedBy="layout", cascade={"persist", "detach" , "merge"})
     */
    private $layoutPositions;

    public function __construct() {
        $this->layoutPositions = new ArrayCollection();
    }

    public function __toString() {
        return $this->id . "<br>" .
                $this->floor . "<br>" .
                $this->maxCols . "<br>" .
                $this->maxRows;
    }

    public function getId() {
        return $this->id;
    }

    public function getFloor() {
        return $this->floor;
    }

    public function getMaxRows() {
        return $this->maxRows;
    }

    public function getMaxCols() {
        return $this->maxCols;
    }

    public function getParkinglot() {
        return $this->parkinglot;
    }

    public function getLayoutPositions() {
        return $this->layoutPositions;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setFloor($floor) {
        $this->floor = $floor;
    }

    public function setMaxRows($maxRows) {
        $this->maxRows = $maxRows;
    }

    public function setMaxCols($maxCols) {
        $this->maxCols = $maxCols;
    }

    public function setParkinglot($parkinglot) {
        $this->parkinglot = $parkinglot;
    }

    public function addLayoutPosition(LayoutPosition $lp) {
        $this->layoutPositions->add($lp);
    }

}
