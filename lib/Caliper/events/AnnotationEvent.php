<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/events/Event.php';
require_once 'Caliper/events/EventContext.php';
require_once 'Caliper/events/EventType.php';

class AnnotationEvent extends Event {
    public function __construct() {
        $this->setContext(EventContext::ANNOTATION);
        $this->setType(EventType::ANNOTATION);
    }
}
