<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/CaliperEntity.php';
require_once 'Caliper/entities/foaf/Agent.php';

class LISPerson extends CaliperEntity implements Agent {
    private $hasMembership = [];

    public function __construct($id) {
		$this->setId($id);
		$this->setType('http://purl.imsglobal.org/caliper/v1/lis/Person');
	}

    public function jsonSerialize(){
        return array_merge(parent::jsonSerialize(), [
            'hasMembership' => $this->getHasMembership(),
        ]);
    }

    public function  getHasMembership() {
        return $this->hasMembership;
    }

    public function  setHasMembership($hasMembership) {
        $this->hasMembership = $hasMembership;
        return $this;
    }
}