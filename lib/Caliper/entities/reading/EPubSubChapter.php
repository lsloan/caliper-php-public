<?php
require_once 'Sensor.php';
require_once 'Caliper/entities/DigitalResource.php';
require_once 'Caliper/entities/schemadotorg/CreativeWork.php';

/**
 *         Representation of an EPUB 3 Volume
 *
 *         A major sub-division of a chapter
 *         http://www.idpf.org/epub/vocab/structure/#subchapter
 */
class EPubSubChapter extends DigitalResource {
    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new DigitalResourceType(DigitalResourceType::EPUB_SUB_CHAPTER));
    }
}