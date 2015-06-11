<?php
require_once 'Sensor.php';
require_once 'Caliper/events/Event.php';
require_once 'Caliper/events/EventType.php';

class AssessmentItemEvent extends Event {
    public function __construct() {
        parent::__construct();
        $this->setType(new EventType(EventType::ASSESSMENT_ITEM));
    }
}
