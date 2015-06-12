<?php
require_once 'Sensor.php';
require_once 'Caliper/entities/Entity.php';
require_once 'Caliper/entities/EntityType.php';
require_once 'Caliper/entities/foaf/Agent.php';

class Person extends Entity implements \foaf\Agent {
    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new EntityType(EntityType::PERSON));
    }
}