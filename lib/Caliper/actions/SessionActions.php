<?php
require_once 'CaliperSensor.php';
require_once 'util/BasicEnum.php';

class SessionActions extends \BasicEnum {
    const
        __default = '',
        LOGGED_IN = 'session.loggedIn',
        LOGGED_OUT = 'session.loggedOut',
        TIMED_OUT = 'session.timedOut';
}
