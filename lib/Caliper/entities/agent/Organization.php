<?php
require_once 'Caliper/entities/Entity.php';
require_once 'Caliper/entities/foaf/Agent.php';
require_once 'Caliper/entities/w3c/Organization.php';

class Organization extends Entity implements \foaf\Agent, \w3c\Organization {
    /** @var \w3c\Organization */
    private $subOrganizationOf;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new EntityType(EntityType::ORGANIZATION));
    }

    /** @return \w3c\Organization */
    public function  getSubOrganizationOf() {
        return $this->subOrganizationOf;
    }

    /**
     * @param \w3c\Organization $subOrganizationOf
     * @return $this|Organization
     */
    public function  setSubOrganizationOf(\w3c\Organization $subOrganizationOf) {
        $this->subOrganizationOf = $subOrganizationOf;
        return $this;
    }
}
