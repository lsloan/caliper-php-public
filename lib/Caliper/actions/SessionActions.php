<?php
require_once 'CaliperSensor.php';
require_once 'util/BasicEnum.php';

class SessionActions extends \BasicEnum {
    const
        __default = '',
        LOGGED_IN = 'http://purl.imsglobal.org/vocab/caliper/v1/action#LoggedIn',
        LOGGED_OUT = 'http://purl.imsglobal.org/vocab/caliper/v1/action#LoggedOut',
        TIMED_OUT = 'http://purl.imsglobal.org/vocab/caliper/v1/action#TimedOut';
}
