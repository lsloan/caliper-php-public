<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/CaliperEntity.php';
require_once 'Caliper/entities/Generatable.php';
require_once 'Caliper/entities/Targetable.php';

class Session extends CaliperEntity implements Generatable, Targetable {
    private $actor;
    private $startedAtTime;
    private $endedAtTime;
    private $duration;

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
            'description' => $this->getDescription(),
            'properties' => (object) $this->getProperties(),
            'dateCreated' => $this->getDateCreated(),
            'dateModified' => $this->getDateModified(),

            'actor' => $this->getActor(),
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