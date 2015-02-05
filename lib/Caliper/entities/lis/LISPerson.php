<?php
$caliperLibDir = dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR;

require_once ($caliperLibDir . 'Caliper/entities/CaliperEntity.php');

class LISPerson extends CaliperEntity {

	public function __construct($id) {
		$this->setId($id);
		$this->setType("http://purl.imsglobal.org/caliper/v1/lis/Person");
	}

}
