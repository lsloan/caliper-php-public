<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/CaliperEntity.php';
require_once 'Caliper/entities/Generatable.php';
require_once 'Caliper/entities/Targetable.php';
require_once 'util/TimestampUtil.php';

class Session extends CaliperEntity implements Generatable, Targetable {
    private $actor;
    private $startedAtTime;
    private $endedAtTime;
    /**
     * @var int Duration in seconds
     */
    private $duration;

    public function __construct($id) {
		parent::__construct();
		$this->setId($id);
		$this->setType('http://purl.imsglobal.org/caliper/v1/Session');
    }
    
    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'actor' => $this->getActor(),
            'startedAtTime' => TimestampUtil::formatTimeISO8601MillisUTC($this->getStartedAtTime()),
            'endedAtTime' => TimestampUtil::formatTimeISO8601MillisUTC($this->getEndedAtTime()),
            'duration' => $this->getDurationFormatted(),
        ]);
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

    /**
     * @param int $durationSeconds
     * @return $this
     */
    public function setDuration($durationSeconds) {
        $this->duration = $durationSeconds;
        return $this;
    }

    /**
     * @return int Duration in seconds
     */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * @return null|string Duration in seconds formatted according to ISO 8601 ("PTnnnnS")
     */
    public function getDurationFormatted() {
        if ($this->getDuration() === null) {
            return null;
        }

        return 'PT' . $this->getDuration() . 'S';
    }
}