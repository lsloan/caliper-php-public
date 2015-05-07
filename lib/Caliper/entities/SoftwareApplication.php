<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/CaliperEntity.php';
require_once 'Caliper/entities/foaf/Agent.php';
require_once 'Caliper/entities/schemadotorg/SoftwareApplication.php';

class SoftwareApplication extends CaliperEntity implements Agent, schemadotorg\SoftwareApplication {
    private $hasMembership = [];

	public function __construct($id) {
		parent::__construct();
		$this->setId($id);
		$this->setType('http://purl.imsglobal.org/caliper/v1/SoftwareApplication');
	}

    public function jsonSerialize(){
        return array_merge(parent::jsonSerialize(), [
            'hasMembership' => $this->getHasMembership(),
        ]);
    }

    public function  getHasMembership() {
        return $this->hasMembership;
    }

    public function  setHasMembership($hasMembership) {
        $this->hasMembership = $hasMembership;
        return $this;
    }
}