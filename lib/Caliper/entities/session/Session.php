<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/Entity.php';
require_once 'Caliper/entities/EntityType.php';
require_once 'Caliper/entities/Generatable.php';
require_once 'Caliper/entities/Targetable.php';
require_once 'util/TimestampUtil.php';

class Session extends Entity implements Generatable, Targetable {
    /** @var Agent */
    private $actor;
    /** @var DateTime */
    private $startedAtTime;
    /** @var DateTime */
    private $endedAtTime;
    /** @var int (seconds) */
    private $duration;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(EntityType::SESSION);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'actor' => $this->getActor(),
            'startedAtTime' => TimestampUtil::formatTimeISO8601MillisUTC($this->getStartedAtTime()),
            'endedAtTime' => TimestampUtil::formatTimeISO8601MillisUTC($this->getEndedAtTime()),
            'duration' => $this->getDurationFormatted(),
        ]);
    }

    /** @return Agent actor */
    public function getActor() {
        return $this->actor;
    }

    /**
     * @param Agent $actor
     * @return $this|Session
     */
    public function setActor($actor) {
        $this->actor = $actor;
        return $this;
    }

    /** @return DateTime startedAtTime */
    public function getStartedAtTime() {
        return $this->startedAtTime;
    }

    /**
     * @param DateTime $startedAtTime
     * @return $this|Session
     */
    public function setStartedAtTime($startedAtTime) {
        $this->startedAtTime = $startedAtTime;
        return $this;
    }

    /** @return DateTime endedAtTime */
    public function getEndedAtTime() {
        return $this->endedAtTime;
    }

    /**
     * @param DateTime $endedAtTime
     * @return $this|Session
     */
    public function setEndedAtTime($endedAtTime) {
        $this->endedAtTime = $endedAtTime;
        return $this;
    }

    /** @return null|string Duration in seconds formatted according to ISO 8601 ("PTnnnnS") */
    public function getDurationFormatted() {
        if ($this->getDuration() === null) {
            return null;
        }

        return 'PT' . $this->getDuration() . 'S';
    }

    /** @return int duration (seconds) */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * @param int $duration (seconds)
     * @return $this|Session
     */
    public function setDuration($duration) {
        $this->duration = $duration;
        return $this;
    }
}