<?php
require_once 'Caliper/entities/Entity.php';
require_once 'Caliper/entities/EntityType.php';

class LearningObjective extends Entity {

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new EntityType(EntityType::LEARNING_OBJECTIVE));
    }
}
