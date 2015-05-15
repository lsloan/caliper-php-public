<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/DigitalResource.php';
require_once 'Caliper/entities/DigitalResourceType.php';
require_once 'Caliper/entities/schemadotorg/CreativeWork.php';

/**
 *         Representation of an EPUB 3 Volume
 *
 *         A major structural division of a piece of writing, typically
 *         encapsulating a set of related chapters.
 *         http://www.idpf.org/epub/vocab/structure/#part
 *
 */
class EPubPart extends DigitalResource implements CreativeWork {
	public function __construct($id) {
		parent::__construct($id);
		$this->setType(DigitalResourceType::EPUB_PART);
	}
}