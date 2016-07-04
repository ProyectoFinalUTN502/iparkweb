<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Rol
 * 
 * @Entity
 * @Table(name="rol")
 */
class Rol {

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
     * @Column(type="integer")
     * @var type 
     */
    private $isActive;

    /**
     * @OneToMany(targetEntity="Permission", mappedBy="rol", cascade={"persist", "detach" , "merge"})
     */
    private $permissions;

    /**
     * @OneToMany(targetEntity="User", mappedBy="rol", cascade={"persist"})
     */
    private $users;

    public function __construct() {
        $this->permissions = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->isActive = 1;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getIsActive() {
        return $this->isActive;
    }

    public function getPermissions() {
        return $this->permissions;
    }

    public function getUsers() {
        return $this->users;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setIsActive($isActive) {
        $this->isActive = $isActive;
    }

    public function setUsers($users) {
        $this->users = $users;
    }

    public function addPermission(Permission $permission) {
        $this->permissions->add($permission);
    }

    public function cleanPermissions() {
        $this->permissions->clear();
    }

    public function canCreate(Group $g) {
        $result = false;
        $filtered = $this->findGroupInRol($g);
        if(!$filtered->isEmpty()){
            $permission = $filtered->first();
            $result = $permission->getGroup()->getCreate() == 1;
        }
        return $result;
    }

    public function canUpdate(Group $g) {
         $result = false;
        $filtered = $this->findGroupInRol($g);
        if(!$filtered->isEmpty()){
            $permission = $filtered->first();
            $result = $permission->getGroup()->getUpdate() == 1;
        }
        return $result;
    }

    public function canDelete(Group $g) {
        $result = false;
        $filtered = $this->findGroupInRol($g);
        if(!$filtered->isEmpty()){
            $permission = $filtered->first();
            $result = $permission->getGroup()->getDelete() == 1;
        }
        return $result;
    }

    public function canList(Group $g) {
        return $g->getList() == 1;
    }

    public function canSearch(Group $g) {
         $result = false;
        $filtered = $this->findGroupInRol($g);
        if(!$filtered->isEmpty()){
            $permission = $filtered->first();
            $result = $permission->getGroup()->getSearch() == 1;
        }
        return $result;
    }

    public function belong(Group $g) {
        $filtered = $this->findGroupInRol($g);
        return !$filtered->isEmpty();
    }

    private function findGroupInRol(Group $g) {
        $filtered = $this->permissions->filter(function($permission) use ($g) {
            $group = $permission->getGroup();
            return $group->getId() == $g->getId();
        });
        
        return $filtered;
    }
}
