<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/events/Event.php';
require_once 'Caliper/events/EventContext.php';
require_once 'Caliper/events/EventType.php';

class AssessmentEvent extends Event {
    public function __construct() {
        parent::__construct();

        $this->setContext(EventContext::ASSESSMENT)
            ->setType(EventType::ASSESSMENT);
    }
}
