<?php
require_once 'Sensor.php';
require_once 'Caliper/entities/media/MediaObject.php';
require_once 'Caliper/entities/media/MediaObjectType.php';
require_once 'Caliper/entities/schemadotorg/ImageObject.php';

class ImageObject extends MediaObject implements schemadotorg\ImageObject {

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new MediaObjectType(MediaObjectType::IMAGE_OBJECT));
    }
}