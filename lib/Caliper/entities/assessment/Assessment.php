<?php
require_once 'Caliper/entities/assignable/AssignableDigitalResource.php';
require_once 'Caliper/entities/assignable/AssignableDigitalResourceType.php';

class Assessment extends AssignableDigitalResource {
    public function __construct($id) {
        parent::__construct($id);
        $this
            ->setId($id)
            ->setType(AssignableDigitalResourceType::ASSESSMENT);
    }
}
