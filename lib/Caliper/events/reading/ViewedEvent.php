<?php


require_once (dirname(dirname(__FILE__)).'/CaliperEvent.php');
require_once (dirname(dirname(dirname(__FILE__))).'/entities/CaliperDigitalResource.php');

/**
 * @author balachandiran.v
 *
 */
class ViewedEvent extends CaliperEvent {

	public function __construct(){
		parent::__construct();

		$this->setContext("http://purl.imsglobal.org/ctx/caliper/v1/ViewedEvent");
		$this->setType("http://purl.imsglobal.org/caliper/v1/ViewedEvent");
		$this->setAction("viewed");
	}
}
