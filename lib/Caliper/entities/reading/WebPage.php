<?php
require_once 'Caliper/entities/DigitalResource.php';
require_once 'Caliper/entities/DigitalResourceType.php';
require_once 'Caliper/entities/schemadotorg/CreativeWork.php';

class WebPage extends DigitalResource implements CreativeWork {

    public function  __construct($id) {
        parent::__construct($id);
        $this->setType(new DigitalResourceType(DigitalResourceType::WEB_PAGE));
    }
}
