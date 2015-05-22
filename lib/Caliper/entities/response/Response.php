<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/EntityType.php';
require_once 'util/BasicEnum.php';
require_once 'util/TimestampUtil.php';

abstract class Response extends Entity implements Generatable {
    /** @var Assignable */
    private $assignable;
    /** @var Agent */
    private $actor;
    /** @var Attempt */
    private $attempt;
    /** @var DateTime */
    private $startedAtTime;
    /** @var DateTime */
    private $endedAtTime;
    /** @var int */
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

    /** @return Assignable assignable */
    public function getAssignable() {
        return $this->assignable;
    }

    /**
     * @param Assignable $assignable
     * @return $this|Response
     */
    public function setAssignable($assignable) {
        $this->assignable = $assignable;
        return $this;
    }

    /** @return Agent actor */
    public function getActor() {
        return $this->actor;
    }

    /**
     * @param Agent $actor
     * @return $this|Response
     */
    public function setActor($actor) {
        $this->actor = $actor;
        return $this;
    }

    /** @return Attempt attempt */
    public function getAttempt() {
        return $this->attempt;
    }

    /**
     * @param Attempt $attempt
     * @return $this|Response
     */
    public function setAttempt($attempt) {
        $this->attempt = $attempt;
        return $this;
    }

    /** @return DateTime startedAtTime */
    public function getStartedAtTime() {
        return $this->startedAtTime;
    }

    /**
     * @param DateTime $startedAtTime
     * @return $this|Response
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
     * @return $this|Response
     */
    public function setEndedAtTime($endedAtTime) {
        $this->endedAtTime = $endedAtTime;
        return $this;
    }

    /** @return int duration */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * @param int $duration
     * @return $this|Response
     */
    public function setDuration($duration) {
        $this->duration = $duration;
        return $this;
    }

}
