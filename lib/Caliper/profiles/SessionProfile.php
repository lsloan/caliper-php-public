<?php
namespace profiles;
require_once '../../util/SplEnumPlus.php';

class Actions extends \SplEnumPlus {
    const
        __default = '',
        LOGGED_IN = 'session.loggedIn',
        LOGGED_OUT = 'session.loggedOut',
        TIMED_OUT = 'session.timedOut';
}

class SessionProfile extends Profile {
}
