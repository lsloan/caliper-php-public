<?php
require_once 'CaliperEntity.php';

class LearningObjective extends CaliperEntity {

    public function __construct($id) {
        parent::__construct();
        $this->setId($id);
        $this->setType('http://purl.imsglobal.org/caliper/v1/LearningObjective');
    }

}
