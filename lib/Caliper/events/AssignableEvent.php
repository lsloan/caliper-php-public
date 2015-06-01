<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/events/Event.php';
require_once 'Caliper/events/EventType.php';

class AssignableEvent extends Event {
    public function __construct() {
        parent::__construct();
        $this->setType(EventType::ASSIGNABLE);
    }
}
