<?php
require_once 'Caliper/entities/Entity.php';
require_once 'Caliper/entities/EntityType.php';
require_once 'Caliper/entities/Generatable.php';
require_once 'util/TimestampUtil.php';

class Attempt extends Entity implements Generatable {
    /** @var Assignable */
    private $assignable;
    /** @var Agent */
    private $actor;
    /** @var int */
    private $count;
    /** @var DateTime */
    private $startedAtTime;
    /** @var DateTime */
    private $endedAtTime;
    /** @var string */
    private $duration;

    public function  __construct($id) {
        $this->setId($id);
        $this->setType(EntityType::ATTEMPT);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'assignable' => $this->getAssignable(),
            'actor' => $this->getActor(),
            'count' => $this->getCount(),
            'startedAtTime' => TimestampUtil::formatTimeISO8601MillisUTC($this->getStartedAtTime()),
            'endedAtTime' => TimestampUtil::formatTimeISO8601MillisUTC($this->getEndedAtTime()),
            'duration' => $this->getDurationFormatted(),
        ]);
    }

    /** @return Assignable assignable */
    public function getAssignable() {
        return $this->assignable;
    }

    /**
     * @param Assignable $assignable
     * @return $this|Attempt
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
     * @return $this|Attempt
     */
    public function setActor($actor) {
        $this->actor = $actor;
        return $this;
    }

    /** @return int count */
    public function getCount() {
        return $this->count;
    }

    /**
     * @param int $count
     * @return $this|Attempt
     */
    public function setCount($count) {
        $this->count = $count;
        return $this;
    }

    /** @return DateTime startedAtTime */
    public function getStartedAtTime() {
        return $this->startedAtTime;
    }

    /**
     * @param DateTime $startedAtTime
     * @return $this|Attempt
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
     * @return $this|Attempt
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

    /** @return string duration */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * @param string $duration
     * @return $this|Attempt
     */
    public function setDuration($duration) {
        $this->duration = $duration;
        return $this;
    }
}
