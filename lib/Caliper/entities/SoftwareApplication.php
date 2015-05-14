<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/CaliperEntity.php';
require_once 'Caliper/entities/foaf/Agent.php';
require_once 'Caliper/entities/schemadotorg/SoftwareApplication.php';

class SoftwareApplication extends CaliperEntity implements Agent, schemadotorg\SoftwareApplication {
    private $roles = [];

	public function __construct($id) {
		parent::__construct($id);
		$this->setType('http://purl.imsglobal.org/caliper/v1/SoftwareApplication');
	}

    public function jsonSerialize(){
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