<?php
require_once 'Caliper/events/Event.php';
require_once 'Caliper/events/EventType.php';
require_once 'Caliper/actions/Action.php';

class OutcomeEvent extends Event {
    public function __construct() {
        parent::__construct();
        $this->setType(new EventType(EventType::OUTCOME))
            ->setAction(new Action(Action::GRADED));
    }
}
