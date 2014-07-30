<?php

require_once (dirname(dirname(__FILE__)).'/CaliperDigitalResource.php');
require_once 'CreativeWork.php';

/**
 * 
 * @author balachandiran.v
 *
 */
class WebPage extends CaliperDigitalResource implements CreativeWork {

	public function  __construct($id) {
		$this->setId($id);
		$this->setType("http://purl.imsglobal.org/caliper/v1/WebPage");
	}

}
