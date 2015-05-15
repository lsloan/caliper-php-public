<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/events/Event.php';
require_once 'Caliper/events/EventContext.php';
require_once 'Caliper/events/EventType.php';
require_once 'Caliper/actions/Action.php';

class OutcomeEvent extends Event {
    public function __construct() {
        parent::__construct();

        $this->setContext(EventContext::OUTCOME)
            ->setType(EventType::OUTCOME)
            ->setAction(Action::GRADED);
    }
}
