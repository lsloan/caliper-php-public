<?php

require_once (dirname(dirname(__FILE__)).'/CaliperEntity.php');


/**
 * @author balachandiran.v
 */
class LISPerson extends CaliperEntity {

	public function __construct($id) {
		$this->setId($id);
		$this->setType("http://purl.imsglobal.org/caliper/v1/LISPerson");
	}

}
