<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/EntityType.php';
require_once 'util/BasicEnum.php';

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
            'actor' => getActor(),
            'assignable' => getAssignable(),
            'attempt' => getAttempt(),
            'duration' => getDuration(),
            'endedAtTime' => getEndedAtTime(),
            'startedAtTime' => getStartedAtTime(),
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
     * @return object
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
     * @return object
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
     * @return object
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
     * @return object
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
     * @return object
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
     * @return object
     */
    public function setDuration($duration) {
        $this->duration = $duration;
        return $this;
    }

}