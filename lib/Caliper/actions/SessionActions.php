<?php
require_once 'CaliperSensor.php';
require_once 'util/SplEnumPlus.php';

class SessionActions extends \SplEnumPlus {
    const
        __default = '',
        LOGGED_IN = 'session.loggedIn',
        LOGGED_OUT = 'session.loggedOut',
        TIMED_OUT = 'session.timedOut';
}
