<?php
if (!defined('CALIPER_LIB_PATH')) {
    throw new Exception('Please require CaliperSensor first.');
}

require_once 'Caliper/entities/CaliperDigitalResource.php';
require_once 'Caliper/entities/schemadotorg/CreativeWork.php';

/**
 *         Representation of an EPUB 3 Volume
 *
 *         A component of a collection
 *         http://www.idpf.org/epub/vocab/structure/#volume
 *
 */
 class EPubVolume extends CaliperDigitalResource implements CreativeWork {

	public function __construct($id) {
		parent::__construct();
		$this->setId($id);
		$this->setType("http://www.idpf.org/epub/vocab/structure/#volume");
	}
}