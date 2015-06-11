<?php
require_once 'Sensor.php';
require_once 'Caliper/entities/Entity.php';
require_once 'Caliper/entities/EntityType.php';
require_once 'Caliper/entities/foaf/Agent.php';
require_once 'Caliper/entities/schemadotorg/SoftwareApplication.php';

class SoftwareApplication extends Entity implements foaf\Agent, schemadotorg\SoftwareApplication {
    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new EntityType(EntityType::SOFTWARE_APPLICATION));
    }
}