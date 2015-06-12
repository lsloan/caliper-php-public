<?php
require_once 'Caliper/entities/EntityType.php';
require_once 'Caliper/util/BasicEnum.php';
require_once 'Caliper/util/TimestampUtil.php';

abstract class Response extends Entity implements Generatable {
    /** @var DigitalResource */
    private $assignable;
    /** @var \foaf\Agent */
    private $actor;
    /** @var Attempt */
    private $attempt;
    /** @var DateTime */
    private $startedAtTime;
    /** @var DateTime */
    private $endedAtTime;
    /** @var string */
    private $duration;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new EntityType(EntityType::RESPONSE));
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'actor' => (!is_null($this->getActor()))
                ? $this->getActor()->getId()
                : null,
            'assignable' => (!is_null($this->getAssignable()))
                ? $this->getAssignable()->getId()
                : null,
            'attempt' => $this->getAttempt(),
            'duration' => $this->getDuration(),
            'endedAtTime' => TimestampUtil::formatTimeISO8601MillisUTC($this->getEndedAtTime()),
            'startedAtTime' => TimestampUtil::formatTimeISO8601MillisUTC($this->getStartedAtTime()),
        ]);
    }

    /** @return DigitalResource assignable */
    public function getAssignable() {
        return $this->assignable;
    }

    /**
     * @param DigitalResource $assignable
     * @return $this|Response
     */
    public function setAssignable(DigitalResource $assignable) {
        $this->assignable = $assignable;
        return $this;
    }

    /** @return \foaf\Agent actor */
    public function getActor() {
        return $this->actor;
    }

    /**
     * @param \foaf\Agent $actor
     * @return $this|Response
     */
    public function setActor(\foaf\Agent $actor) {
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
    public function setAttempt(Attempt $attempt) {
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
    public function setStartedAtTime(DateTime $startedAtTime) {
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
    public function setEndedAtTime(DateTime $endedAtTime) {
        $this->endedAtTime = $endedAtTime;
        return $this;
    }

    /** @return string duration */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * @param string $duration
     * @return $this|Response
     */
    public function setDuration($duration) {
        if (!is_string($duration)) {
            throw new InvalidArgumentException(__METHOD__ . ': string expected');
        }

        $this->duration = $duration;
        return $this;
    }

}
