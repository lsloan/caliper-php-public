<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/CaliperDigitalResource.php';
require_once 'Caliper/entities/schemadotorg/CreativeWork.php';
require_once 'Caliper/entities/CaliperDigitalResourceTypes.php';

/**
 *         Representation of an EPUB 3 Volume
 *
 *         A component of a collection
 *         http://www.idpf.org/epub/vocab/structure/#volume
 *
 */
class EPubVolume extends CaliperDigitalResource implements CreativeWork {
    private $version;

    public function __construct($id) {
        parent::__construct();
        $this->setId($id);
        $this->setType(CaliperDigitalResourceTypes::EPUB_VOLUME);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'version' => $this->getVersion(),
        ]);
    }

    /**
     * @return mixed
     */
    public function getVersion() {
        return $this->version;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version) {
        $this->version = $version;
        return $this;
    }
}