<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/DigitalResource.php';
require_once 'Caliper/entities/schemadotorg/CreativeWork.php';
require_once 'Caliper/entities/DigitalResourceType.php';

/**
 *         Representation of an EPUB 3 Volume
 *
 *         A component of a collection
 *         http://www.idpf.org/epub/vocab/structure/#volume
 *
 */
class EPubVolume extends DigitalResource implements CreativeWork {

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new DigitalResourceType(DigitalResourceType::EPUB_VOLUME));
    }
}