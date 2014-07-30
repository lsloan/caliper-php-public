<?php
require_once 'CaliperEntity.php';

/**
 * @author balachandiran.v
 *
 */
class LearningObjective extends CaliperEntity {

	public function __construct($id) {
		$this->setId($id);
		$this->setType("http://purl.imsglobal.org/caliper/v1/LearningObjective");
	}

}
