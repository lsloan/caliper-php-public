<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/Entity.php';
require_once 'Caliper/entities/foaf/Agent.php';

class Organization extends Entity implements foaf\Agent, w3c\Organization {
    /** @var w3c\Organization */
    private $parentOrg;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new EntityType(EntityType::ORGANIZATION));
    }

    public function jsonSerialize() {
        $serializedParent = parent::jsonSerialize();

        // This class doesn't use these properties, so unset them.
        unset($serializedParent['name']);
        unset($serializedParent['description']);

        return $serializedParent;
    }

    /** @return w3c\Organization */
    public function  getParentOrg() {
        return $this->parentOrg;
    }

    /**
     * @param w3c\Organization $parentOrg
     * @return $this|Organization
     */
    public function  setParentOrg(w3c\Organization $parentOrg) {
        $this->parentOrg = $parentOrg;
        return $this;
    }

}
