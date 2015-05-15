<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/events/Event.php';
require_once 'Caliper/events/EventContext.php';
require_once 'Caliper/events/EventType.php';
require_once 'Caliper/entities/DigitalResource.php';
require_once 'Caliper/actions/Action.php';


class ViewedEvent extends Event {

	public function __construct(){
		parent::__construct();

        $this->setContext(EventContext::VIEWED);
        $this->setType(EventType::VIEWED);
        $this->setAction(Action::VIEWED);
	}
}
