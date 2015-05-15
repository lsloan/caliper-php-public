<?php
require_once 'Caliper/entities/w3c/Organization.php';
require_once 'Caliper/entities/EntityType.php';

class Group extends Entity implements w3c\Organization {
    private $membership = [];
    private $subOrganizationOf;

    public function __construct($id) {
        $this->setId($id);
        $this->setType(EntityType::GROUP);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'subOrganizationOf' => $this->getSubOrganizationOf(),
        ]);
    }

    /**
     * @return mixed
     */
    public function getSubOrganizationOf() {
        return $this->subOrganizationOf;
    }

    /**
     * @param mixed $subOrganizationOf
     */
    public function setSubOrganizationOf($subOrganizationOf) {
        $this->subOrganizationOf = $subOrganizationOf;
        return $this;
    }

    /**
     * @return array
     */
    public function getMembership() {
        return $this->membership;
    }

    /**
     * @param array $membership
     */
    public function setMembership($membership) {
        $this->membership = $membership;
        return $this;
    }
}
