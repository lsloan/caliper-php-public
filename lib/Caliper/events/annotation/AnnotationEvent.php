<?php

require_once dirname(__FILE__).'/../CaliperEvent.php';
require_once (dirname(dirname(dirname(__FILE__))).'/actions/AnnotationActions.php');

/**
 * @author balachandiran.v
 *
 */
class AnnotationEvent extends CaliperEvent {
	
	public function __construct(){

        $this->setContext(CaliperEventContexts::ANNOTATION);
        $this->setType(CaliperEventTypes::ANNOTATION);

	}

	public static function forAction($action) {

		$event = new AnnotationEvent();

        // Add check to see if $action exists in AnnotationActions enum
		$event->setAction($action);
        
		return $event;
	}
}
