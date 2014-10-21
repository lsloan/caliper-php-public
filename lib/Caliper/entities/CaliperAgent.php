<?php

require_once dirname(__FILE__).'/foaf/Agent.php';

/**
 *@author balachandiran.v
 *
 */
class CaliperAgent extends CaliperEntity implements Agent, JsonSerializable {

    function __construct() {
        parent::__construct();
    }
}
