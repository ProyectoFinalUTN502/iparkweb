<?php

/**
 * Param
 *
 * @Entity 
 * @Table(name="param")
 */
class Param {
    
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
    private $keyParam;
    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $valueParam;
    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $keyText;
    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $valueText;
    
    
    
    function getId() {
        return $this->id;
    }

    function getKeyParam() {
        return $this->keyParam;
    }

    function getValueParam() {
        return $this->valueParam;
    }

    function getKeyText() {
        return $this->keyText;
    }

    function getValueText() {
        return $this->valueText;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setKeyParam($keyParam) {
        $this->keyParam = $keyParam;
    }

    function setValueParam($valueParam) {
        $this->valueParam = $valueParam;
    }

    function setKeyText($keyText) {
        $this->keyText = $keyText;
    }

    function setValueText($valueText) {
        $this->valueText = $valueText;
    }


}
