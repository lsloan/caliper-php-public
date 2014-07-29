<?php

require_once dirname(__FILE__).'/../CaliperEvent.php';

/**
 * 
 *
 */
class AnnotationEvent extends CaliperEvent {
	
	public function __construct(){
			$this->setContext("http://purl.imsglobal.org/ctx/caliper/v1/AnnotationEvent");
			$this->setType("http://purl.imsglobal.org/caliper/v1/AnnotationEvent");
	
	}

	public static function forAction($action) {
		$event = new AnnotationEvent();
		$event->setAction($action);
		return $event;
	}
}
