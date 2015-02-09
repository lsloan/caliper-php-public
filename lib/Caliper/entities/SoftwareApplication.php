<?php
if (!defined('CALIPER_LIB_PATH')) {
    throw new Exception('Please require CaliperSensor first.');
}

require_once 'Caliper/entities/CaliperAgent.php';

class SoftwareApplication extends CaliperAgent{

	public function __construct($id) {
        parent::__construct();
		$this->setId($id);
		$this->setType('http://purl.imsglobal.org/caliper/v1/SoftwareApplication');
	}

}