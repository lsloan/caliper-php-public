<?php
$caliperLibDir = '/Users/lsloan/Projects/caliper-php-lsloan/lib/';
//$caliperLibDir = dirname(dirname(dirname(__FILE__))) . '/';

require_once($caliperLibDir . '/Caliper/events/CaliperEvent.php');
require_once($caliperLibDir . '/Caliper/events/CaliperEventContexts.php');
require_once($caliperLibDir . '/Caliper/events/CaliperEventTypes.php');
require_once($caliperLibDir . '/Caliper/entities/CaliperDigitalResource.php');
require_once($caliperLibDir . '/Caliper/actions/SessionActions.php');

/*
require_once (dirname(dirname(__FILE__)).'/CaliperEvent.php');
require_once (dirname(dirname(dirname(__FILE__))).'/entities/CaliperDigitalResource.php');
require_once (dirname(dirname(dirname(__FILE__))).'/actions/SessionActions.php');
*/

class SessionEvent extends CaliperEvent {

	public function __construct(){
		parent::__construct();

		$this->setContext(CaliperEventContexts::SESSION);
		$this->setType(CaliperEventTypes::VIEWED);
		/*
		$this->setAction(ReadingActions::VIEWED);
		*/
	}
}
