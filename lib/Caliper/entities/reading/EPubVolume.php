<?php
$caliperLibDir = dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR;

require_once ($caliperLibDir . 'Caliper/entities/CaliperDigitalResource.php');
require_once ($caliperLibDir . 'Caliper/entities/schemadotorg/CreativeWork.php');

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