<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Group
 * 
 * @Entity
 * @Table(name="`group`")
 */
class Group {
    
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
    private $name;
    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $text;
    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $description;
    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $style;
    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $ref;
     /**
     * @Column(type="integer")
     * @var type 
     */
    private $create;
    /**
     * @Column(type="integer")
     * @var type 
     */
    private $delete;
    /**
     * @Column(type="integer")
     * @var type 
     */
    private $update;
    /**
     * @Column(type="integer")
     * @var type 
     */
    private $list;
    /**
     * @Column(type="integer")
     * @var type 
     */
    private $search;
    /**
     * @OneToMany(targetEntity="Permission", mappedBy="permission")
     */
    private $permissions;
        
    public function __construct($id = "") {
        
        if($id != ""){
            $this->id = $id;
        }
        
        $this->permissions = new ArrayCollection();
    }
    
    public function setName($name) {
        $this->name = $name;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setStyle($style) {
        $this->style = $style;
    }

    public function setRef($ref) {
        $this->ref = $ref;
    }

    public function setCreate($create) {
        $this->create = $create;
    }

    public function setDelete($delete) {
        $this->delete = $delete;
    }

    public function setUpdate($update) {
        $this->update = $update;
    }

    public function setList($list) {
        $this->list = $list;
    }

    public function setSearch($search) {
        $this->search = $search;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getText() {
        return $this->text;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getStyle() {
        return $this->style;
    }

    public function getRef() {
        return $this->ref;
    }

    public function getCreate() {
        return $this->create;
    }

    public function getDelete() {
        return $this->delete;
    }

    public function getUpdate() {
        return $this->update;
    }

    public function getList() {
        return $this->list;
    }

    public function getSearch() {
        return $this->search;
    }
    
    public function getPermissions() {
        return $this->permissions;
    }



}
