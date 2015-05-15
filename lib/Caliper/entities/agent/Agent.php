<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/foaf/Agent.php';

class Agent extends CaliperEntity implements foaf\Agent {

    function __construct($id) {
        parent::__construct($id);
    }
}
