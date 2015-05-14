<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/media/MediaObject.php';
require_once 'Caliper/entities/schemadotorg/VideoObject.php';

class VideoObject extends MediaObject implements schemadotorg\VideoObject {

    public function __construct($id) {
        parent::__construct($id);
        $this->setType('http://purl.imsglobal.org/caliper/v1/VideoObject');
    }
}