<?php
require_once 'CaliperEntity.php';

/**
 * @author balachandiran.v
 *
 */
class LearningObjective extends CaliperEntity {

	public function __construct($id) {
        parent::__construct($id);
		$this->setType("http://purl.imsglobal.org/caliper/v1/LearningObjective");
	}

}
