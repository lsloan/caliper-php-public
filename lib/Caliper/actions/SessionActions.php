<?php
$caliperLibDir = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR;

require_once($caliperLibDir . 'util/SplEnumPlus.php');

class SessionActions extends \SplEnumPlus {
    const
        __default = '',
        LOGGED_IN = 'loggedIn',
        LOGGED_OUT = 'loggedOut',
        TIMED_OUT = 'timedOut';
}

