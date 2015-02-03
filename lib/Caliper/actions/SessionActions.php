<?php
$caliperDir = '/Users/lsloan/Projects/caliper-php-lsloan/lib/Caliper';
//$caliperDir = dirname(dirname(dirname(__FILE__)));

require_once(dirname($caliperDir) . '/util/SplEnumPlus.php');

class SessionActions extends \SplEnumPlus {
    const
        __default = '',
        LOGGED_IN = 'session.loggedIn',
        LOGGED_OUT = 'session.loggedOut',
        TIMED_OUT = 'session.timedOut';
}

