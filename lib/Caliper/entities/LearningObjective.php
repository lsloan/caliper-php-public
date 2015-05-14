<?php
require_once 'CaliperEntity.php';
require_once 'Caliper/entities/EntityType.php';

class LearningObjective extends CaliperEntity {

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(EntityType::LEARNING_OBJECTIVE);
    }
}
