<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/events/CaliperEvent.php';
require_once 'Caliper/events/CaliperEventContexts.php';
require_once 'Caliper/events/CaliperEventTypes.php';
require_once 'Caliper/entities/CaliperDigitalResource.php';
require_once 'Caliper/actions/SessionActions.php';

class SessionEvent extends CaliperEvent {
	public function __construct(){
		parent::__construct();

		$this->setContext(CaliperEventContexts::SESSION);
		$this->setType(CaliperEventTypes::SESSION);
	}
}
