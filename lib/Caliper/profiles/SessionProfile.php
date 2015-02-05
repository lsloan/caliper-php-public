<?php
namespace profiles;
$caliperLibDir = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR;

require_once($caliperLibDir . 'util/SplEnumPlus.php');
require_once($caliperLibDir . 'Caliper/entities/CaliperDigitalResource.php');
require_once($caliperLibDir . 'Caliper/entities/schemadotorg/CreativeWork.php');

class Actions extends \SplEnumPlus {
    const
        __default = '',
        LOGGED_IN = 'session.loggedIn',
        LOGGED_OUT = 'session.loggedOut',
        TIMED_OUT = 'session.timedOut';
}

class SessionProfile extends Profile {
}
