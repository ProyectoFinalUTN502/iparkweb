<?php

/**
 * Permission
 * 
 * @Entity
 * @Table(name="permission")
 */
class Permission {

    /**
     * @Id
     * @ManyToOne(targetEntity="Rol", inversedBy="permissions")
     * @JoinColumn(name="rol_id", referencedColumnName="id")
     */
    private $rol;

    /**
     * @Id
     * @ManyToOne(targetEntity="Group", inversedBy="permissions")
     * @JoinColumn(name="group_id", referencedColumnName="id")
     */
    private $group;

    public function __construct(ROl $rol = null, Group $group = null) {

        if ($rol != null) {
            $this->rol = $rol;
        }

        if ($group != null) {
            $this->group = $group;
        }
    }

    public function getRol() {
        return $this->rol;
    }

    public function getGroup() {
        return $this->group;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

    public function setGroup($group) {
        $this->group = $group;
    }

}
