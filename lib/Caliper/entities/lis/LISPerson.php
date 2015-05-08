<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/CaliperEntity.php';
require_once 'Caliper/entities/CaliperAgentTypes.php';
require_once 'Caliper/entities/foaf/Agent.php';

class LISPerson extends CaliperEntity implements Agent {
    private $roles = [];

    public function __construct($id) {
		$this->setId($id);
		$this->setType(CaliperAgentTypes::LIS_PERSON);
	}

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'roles' => $this->getRoles(),
        ]);
    }

    public function  getRoles() {
        return $this->roles;
    }

    public function  setRoles($roles) {
        $this->roles = $roles;
        return $this;
    }
}