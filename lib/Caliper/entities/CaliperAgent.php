<?php
require_once dirname(__FILE__) . '/foaf/Agent.php';

class CaliperAgent extends CaliperEntity implements Agent, JsonSerializable {
    function __construct() {
        parent::__construct();
    }
}
