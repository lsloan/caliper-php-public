<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/EntityType.php';
require_once 'util/BasicEnum.php';
require_once 'util/TimestampUtil.php';

class Response extends Entity implements Generatable {
    private $assignable;
    private $actor;
    private $attempt;
    private $startedAtTime;
    private $endedAtTime;
    private $duration;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(EntityType::RESPONSE);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'actor' => $this->getActor(),
            'assignable' => $this->getAssignable(),
            'attempt' => $this->getAttempt(),
            'duration' => $this->getDuration(),
            'endedAtTime' => TimestampUtil::formatTimeISO8601MillisUTC($this->getEndedAtTime()),
            'startedAtTime' => TimestampUtil::formatTimeISO8601MillisUTC($this->getStartedAtTime()),
        ]);
    }

    /**
     * @return mixed
     */
    public function getAssignable() {
        return $this->assignable;
    }

    /**
     * @param mixed $assignable
     * @return $this|Response
     */
    public function setAssignable($assignable) {
        $this->assignable = $assignable;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getActor() {
        return $this->actor;
    }

    /**
     * @param mixed $actor
     * @return $this|Response
     */
    public function setActor($actor) {
        $this->actor = $actor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAttempt() {
        return $this->attempt;
    }

    /**
     * @param mixed $attempt
     * @return $this|Response
     */
    public function setAttempt($attempt) {
        $this->attempt = $attempt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStartedAtTime() {
        return $this->startedAtTime;
    }

    /**
     * @param mixed $startedAtTime
     * @return $this|Response
     */
    public function setStartedAtTime($startedAtTime) {
        $this->startedAtTime = $startedAtTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndedAtTime() {
        return $this->endedAtTime;
    }

    /**
     * @param mixed $endedAtTime
     * @return $this|Response
     */
    public function setEndedAtTime($endedAtTime) {
        $this->endedAtTime = $endedAtTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     * @return $this|Response
     */
    public function setDuration($duration) {
        $this->duration = $duration;
        return $this;
    }

}