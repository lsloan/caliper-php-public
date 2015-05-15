<?php
namespace profiles;

require_once 'CaliperSensor.php';
require_once 'util/BasicEnum.php';
require_once 'Caliper/entities/DigitalResource.php';
require_once 'Caliper/entities/schemadotorg/CreativeWork.php';

class Actions extends \BasicEnum {
    const
        __default = '',
        LOGGED_IN = 'session.loggedIn',
        LOGGED_OUT = 'session.loggedOut',
        TIMED_OUT = 'session.timedOut';
}

class SessionProfile extends Profile {
}
