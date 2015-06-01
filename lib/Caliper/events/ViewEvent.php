<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/events/Event.php';
require_once 'Caliper/events/EventType.php';
require_once 'Caliper/entities/DigitalResource.php';
require_once 'Caliper/actions/Action.php';


class ViewEvent extends Event {

	public function __construct(){
		parent::__construct();
        $this->setType(EventType::VIEW)
            ->setAction(Action::VIEWED);
	}
}
