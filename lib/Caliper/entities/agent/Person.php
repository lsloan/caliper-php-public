<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/Entity.php';
require_once 'Caliper/entities/EntityType.php';
require_once 'Caliper/entities/agent/Agent.php';
require_once 'Caliper/entities/foaf/Agent.php';

class Person extends Agent implements foaf\Agent {
    private $roles = [];

    public function __construct($id) {
		$this->setId($id);
		$this->setType(EntityType::PERSON);
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