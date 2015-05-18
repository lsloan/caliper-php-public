<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/Type.php';
require_once 'util/BasicEnum.php';

class AssignableDigitalResourceType extends BasicEnum implements Type {
    const
        __default = '',
        ASSESSMENT = 'http://purl.imsglobal.org/caliper/v1/Assessment',
        ASSESSMENT_ITEM = 'http://purl.imsglobal.org/caliper/v1/AssessmentItem';
}