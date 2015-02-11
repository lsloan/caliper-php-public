<?php
if (!defined('CALIPER_LIB_PATH')) {
    throw new Exception('Please require CaliperSensor first.');
}

require_once 'Caliper/entities/CaliperEntity.php';

class LISPerson extends CaliperEntity {
	public function __construct($id) {
		$this->setId($id);
		$this->setType("http://purl.imsglobal.org/caliper/v1/lis/Person");
	}
}