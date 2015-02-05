<?php
$caliperLibDir = dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR;

require_once($caliperLibDir . 'Caliper/events/CaliperEvent.php');
require_once($caliperLibDir . 'Caliper/events/CaliperEventContexts.php');
require_once($caliperLibDir . 'Caliper/events/CaliperEventTypes.php');
require_once($caliperLibDir . 'Caliper/entities/CaliperDigitalResource.php');
require_once($caliperLibDir . 'Caliper/actions/SessionActions.php');

class SessionEvent extends CaliperEvent {

	public function __construct(){
		parent::__construct();

		$this->setContext(CaliperEventContexts::SESSION);
		$this->setType(CaliperEventTypes::SESSION);
		/*
		$this->setAction(ReadingActions::VIEWED);
		*/
	}
}
