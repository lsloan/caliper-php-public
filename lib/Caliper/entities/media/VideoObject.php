<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/media/MediaObject.php';
require_once 'Caliper/entities/schemadotorg/VideoObject.php';

class VideoObject extends MediaObject implements schemadotorg\VideoObject {
    private $version;

    public function __construct($id) {
		parent::__construct();
		$this->setId($id);
		$this->setType('http://purl.imsglobal.org/caliper/v1/VideoObject');
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