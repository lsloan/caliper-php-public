<?php
if (!defined('CALIPER_LIB_PATH')) {
    throw new Exception('Please require CaliperSensor first.');
}

require_once 'util/SplEnumPlus.php';

class SessionActions extends \SplEnumPlus {
    const
        __default = '',
        LOGGED_IN = 'logged in',
        LOGGED_OUT = 'logged out',
        TIMED_OUT = 'timed out';
}

