<?php
require_once 'util/BasicEnum.php';

class AssessmentActions extends BasicEnum {
    const
        __default = '',
        STARTED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Started',
        PAUSED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Paused',
        RESTARTED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Restarted',
        SUBMITTED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Submitted';
}

