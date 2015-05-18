<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/Entity.php';
require_once 'Caliper/entities/EntityType.php';
require_once 'Caliper/entities/agent/Agent.php';
require_once 'Caliper/entities/foaf/Agent.php';

class Person extends Agent implements foaf\Agent {
    public function __construct($id) {
        $this->setId($id);
        $this->setType(EntityType::PERSON);
    }
}