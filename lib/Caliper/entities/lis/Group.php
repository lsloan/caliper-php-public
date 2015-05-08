<?php
require_once 'Caliper/entities/w3c/Organization.php';

class Group extends CaliperEntity implements w3c\Organization {
    private $membership = [];
    private $subOrganizationOf;

    public function __construct($id) {
        $this->setId($id);
        $this->setType('http://purl.imsglobal.org/caliper/v1/lis/Group');
    }

    public function jsonSerialize(){
        return array_merge(parent::jsonSerialize(), [
            'subOrganizationOf' => $this->getSubOrganizationOf(),
        ]);
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
}
