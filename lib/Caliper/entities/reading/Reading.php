<?php
require_once 'Caliper/entities/DigitalResource.php';
require_once 'Caliper/entities/DigitalResourceType.php';

class Reading extends DigitalResource {
    public function  __construct($id) {
        parent::__construct($id);
        $this->setType(new DigitalResourceType(DigitalResourceType::READING));
    }
}