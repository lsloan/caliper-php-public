<?php
$caliperLibDir = dirname(dirname(dirname(dirname(__FILE__)))) . '/lib/';

require_once($caliperLibDir . 'util/SplEnumPlus.php');

class SessionActions extends \SplEnumPlus {
    const
        __default = '',
        LOGGED_IN = 'session.loggedIn',
        LOGGED_OUT = 'session.loggedOut',
        TIMED_OUT = 'session.timedOut';
}

