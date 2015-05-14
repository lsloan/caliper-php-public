<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/CaliperDigitalResource.php';
require_once 'Caliper/entities/schemadotorg/CreativeWork.php';

/**
 *         Representation of an EPUB 3 Volume
 *
 *         A major structural division of a piece of writing, typically
 *         encapsulating a set of related chapters.
 *         http://www.idpf.org/epub/vocab/structure/#part
 *
 */
class EPubPart extends CaliperDigitalResource implements CreativeWork {
	public function __construct($id) {
		parent::__construct($id);
		$this->setType("http://www.idpf.org/epub/vocab/structure/#part");
	}
}