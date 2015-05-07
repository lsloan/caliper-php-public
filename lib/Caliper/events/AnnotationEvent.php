<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/events/CaliperEvent.php';
require_once 'Caliper/events/CaliperEventContexts.php';
require_once 'Caliper/events/CaliperEventTypes.php';
require_once 'Caliper/actions/Action.php';

class AnnotationEvent extends CaliperEvent {
	
	public function __construct(){

        $this->setContext(CaliperEventContexts::ANNOTATION);
        $this->setType(CaliperEventTypes::ANNOTATION);

	}

	public static function forAction($action) {

		$event = new AnnotationEvent();

        // Add check to see if $action exists in Action enum
		$event->setAction($action);

		return $event;
	}
}
