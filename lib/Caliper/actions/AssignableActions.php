<?php
require_once 'util/BasicEnum.php';

class AssignableActions extends BasicEnum {

    const
        __default = '',
        ABANDONED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Abandoned',
        ACTIVATED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Activated',
        COMPLETED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Completed',
        DEACTIVATED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Deactivated',
        HID = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Hid',
        REVIEWED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Reviewed',
        SHOWED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Showed',
        STARTED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Started',
        SUBMITTED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Submitted';
}

