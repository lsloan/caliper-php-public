<?php
$caliperLibDir = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR;

require_once($caliperLibDir . 'Caliper/entities/CaliperEntity.php');

class Session extends CaliperEntity {

    public $actor;
    public $startedAtTime;
    public $endedAtTime;
    public $duration;

    public function __construct($id) {
		parent::__construct();
		$this->setId($id);
		$this->setType('http://purl.imsglobal.org/caliper/v1/Session');
    }
    
    /**
     ** @see JsonSerializable::jsonSerialize()
     *to implement jsonLD
     */

    public function jsonSerialize() {
        return [
            '@id' => $this->getId(),
            '@type' => $this->getType(),
            'name' => $this->getName(),
            'properties'=>(object) $this->getProperties(),
            'lastModifiedTime' => $this->getLastModifiedAt(),

            // JS code had an actor here, but this JSON doesn't match test fixture
            //'actor' => $this->getActor(),
            'startedAtTime' => $this->getStartedAtTime(),
            'endedAtTime' => $this->getEndedAtTime(),
            'duration' => $this->getDuration(),
        ];
    }

    public function setActor($value) {
        $this->actor = $value;
        return $this;
    }
    
    public function getActor() {
        return $this->actor;
    }
    
    public function setStartedAtTime($value) {
        $this->startedAtTime = $value;
        return $this;
    }
    
    public function getStartedAtTime() {
        return $this->startedAtTime;
    }
    
    public function setEndedAtTime($value) {
        $this->endedAtTime = $value;
        return $this;
    }
    
    public function getEndedAtTime() {
        return $this->endedAtTime;
    }
    
    public function setDuration($value) {
        $this->duration = $value;
        return $this;
    }
    
    public function getDuration() {
        return $this->duration;
    }    
}