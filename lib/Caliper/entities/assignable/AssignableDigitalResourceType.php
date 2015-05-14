<?php
require_once 'util/BasicEnum.php';

class AssignableDigitalResourceType extends BasicEnum {
    const
        __default = '',
        ASSESSMENT = 'http://purl.imsglobal.org/caliper/v1/Assessment',
        ASSESSMENT_ITEM = 'http://purl.imsglobal.org/caliper/v1/AssessmentItem';
}