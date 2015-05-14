<?php
require_once 'Caliper/entities/CaliperDigitalResource.php';
require_once 'CreativeWork.php';

class WebPage extends CaliperDigitalResource implements CreativeWork {

	public function  __construct($id) {
        parent::__construct($id);
		$this->setType("http://purl.imsglobal.org/caliper/v1/WebPage");
	}
}
