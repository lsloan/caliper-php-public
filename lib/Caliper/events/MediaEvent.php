<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/events/CaliperEvent.php';
require_once 'Caliper/events/CaliperEventContexts.php';
require_once 'Caliper/events/CaliperEventTypes.php';
require_once 'Caliper/entities/CaliperDigitalResource.php';

class MediaEvent extends CaliperEvent {
	public function __construct(){
		parent::__construct();

		$this->setContext(CaliperEventContexts::MEDIA);
		$this->setType(CaliperEventTypes::MEDIA);
	}
}
