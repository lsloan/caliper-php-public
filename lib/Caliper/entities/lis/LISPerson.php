<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/CaliperEntity.php';
require_once 'Caliper/entities/foaf/Agent.php';

class LISPerson extends CaliperEntity implements Agent {
	public function __construct($id) {
		$this->setId($id);
		$this->setType("http://purl.imsglobal.org/caliper/v1/lis/Person");
	}
}