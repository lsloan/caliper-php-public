<?php
/**
 *
 */
/*@CaliperLearningContext*/

class SoftwareApplication extends CaliperEntity{

	public function __construct($id) {
		$this->setId($id);
		$this->setType("http://purl.imsglobal.org/caliper/v1/SoftwareApplication");
	}

}