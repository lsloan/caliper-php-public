<?php
require_once 'Caliper/entities/w3c/Organization.php';
require_once 'Caliper/entities/EntityType.php';

class Group extends Entity implements w3c\Organization {
    /** @var Course */
    private $subOrganizationOf;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new EntityType(EntityType::GROUP));
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'subOrganizationOf' => $this->getSubOrganizationOf(),
        ]);
    }

    /** @return Course subOrganizationOf */
    public function getSubOrganizationOf() {
        return $this->subOrganizationOf;
    }

    /**
     * @param Course $subOrganizationOf
     * @return $this|Group
     */
    public function setSubOrganizationOf(Course $subOrganizationOf) {
        $this->subOrganizationOf = $subOrganizationOf;
        return $this;
    }
}


