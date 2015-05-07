<?php
require_once 'util/BasicEnum.php';

class AssessmentItemActions extends BasicEnum {
    const
        __default = '',
        STARTED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Started',
        COMPLETED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Completed',
        SKIPPED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Skipped',
        REVIEWED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Reviewed',
        VIEWED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Viewed';
}

