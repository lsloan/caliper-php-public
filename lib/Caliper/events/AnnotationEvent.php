<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/events/Event.php';
require_once 'Caliper/events/EventContext.php';
require_once 'Caliper/events/EventType.php';
require_once 'Caliper/actions/Action.php';

class AnnotationEvent extends Event {
	
	public function __construct(){

        $this->setContext(EventContext::ANNOTATION);
        $this->setType(EventType::ANNOTATION);

	}

	public static function forAction($action) {

		$event = new AnnotationEvent();

        // Add check to see if $action exists in Action enum
		$event->setAction($action);

		return $event;
	}
}
