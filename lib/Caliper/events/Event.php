<?php
require_once 'Caliper/context/Context.php';
require_once 'Caliper/util/ClassUtil.php';
require_once 'Caliper/util/TimestampUtil.php';

abstract class Event extends ClassUtil implements JsonSerializable {
    /** @var Context */
    private $context;
    /** @var EventType */
    private $type;
    /** @var \foaf\Agent */
    private $actor;
    /** @var Action */
    private $action;
    /** @var object */
    private $object;
    /** @var Targetable */
    private $target;
    /** @var Generatable */
    private $generated;
    /** @var DateTime */
    private $startedAtTime;
    /** @var DateTime */
    private $endedAtTime;
    /** @var string */
    private $duration;
    /** @var SoftwareApplication */
    private $edApp;
    /** @var Organization */
    private $group;
    /** @var Membership */
    private $membership;
    /** @var Session */
    private $federatedSession;

    public function __construct() {
        $this->setContext(new Context(Context::CONTEXT));
    }

    public function jsonSerialize() {
        return [
            '@context' => $this->getContext(),
            '@type' => $this->getType(),
            'actor' => $this->getActor(),
            'action' => $this->getAction(),
            'object' => $this->getObject(),
            'target' => $this->getTarget(),
            'generated' => $this->getGenerated(),
            'startedAtTime' => TimestampUtil::formatTimeISO8601MillisUTC($this->getStartedAtTime()),
            'endedAtTime' => TimestampUtil::formatTimeISO8601MillisUTC($this->getEndedAtTime()),
            'duration' => $this->getDurationFormatted(),
            'edApp' => $this->getEdApp(),
            'group' => $this->getGroup(),
            'membership' => $this->getMembership(),
            'federatedSession' => (!is_null($this->getFederatedSession()))
                ? $this->getFederatedSession()->getId()
                : null,
        ];
    }

    /** @return Context context */
    public function getContext() {
        return $this->context;
    }

    /**
     * @param Context $context
     * @return $this|Event
     */
    public function setContext(Context $context) {
        $this->context = $context;
        return $this;
    }

    /** @return EventType type */
    public function getType() {
        return $this->type;
    }

    /**
     * @param EventType $type
     * @return $this|Event
     */
    public function setType(EventType $type) {
        $this->type = $type;
        return $this;
    }

    /** @return \foaf\Agent actor */
    public function getActor() {
        return $this->actor;
    }

    /**
     * @param \foaf\Agent $actor
     * @return $this|Event
     */
    public function setActor(\foaf\Agent $actor) {
        $this->actor = $actor;
        return $this;
    }

    /** @return Action action */
    public function getAction() {
        return $this->action;
    }

    /**
     * @param Action $action
     * @return $this|Event
     */
    public function setAction(Action $action) {
        $this->action = $action;
        return $this;
    }

    /** @return object object */
    public function getObject() {
        return $this->object;
    }

    /**
     * @param object $object
     * @return $this|Event
     */
    public function setObject($object) {
        if (!is_object($object)) {
            throw new InvalidArgumentException(__METHOD__ . ': object expected');
        }

        $this->object = $object;
        return $this;
    }

    /** @return Targetable target */
    public function getTarget() {
        return $this->target;
    }

    /**
     * @param Targetable $target
     * @return $this|Event
     */
    public function setTarget(Targetable $target) {
        $this->target = $target;
        return $this;
    }

    /** @return Generatable generated */
    public function  getGenerated() {
        return $this->generated;
    }

    /**
     * @param Generatable $generated
     * @return $this|Event
     */
    public function setGenerated(Generatable $generated) {
        $this->generated = $generated;
        return $this;
    }

    /** @return DateTime startedAtTime */
    public function getStartedAtTime() {
        return $this->startedAtTime;
    }

    /**
     * @param DateTime $startedAtTime
     * @return $this|Event
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
     * @return $this|Event
     */
    public function setEndedAtTime(DateTime $endedAtTime) {
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

    /** @return string duration (seconds) */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * @param string $duration
     * @return $this|Event
     */
    public function setDuration($duration) {
        if (!is_string($duration)) {
            throw new InvalidArgumentException(__METHOD__ . ': string expected');
        }

        $this->duration = $duration;
        return $this;
    }

    /** @return SoftwareApplication edApp */
    public function getEdApp() {
        return $this->edApp;
    }

    /**
     * @param SoftwareApplication $edApp
     * @return $this|Event
     */
    public function setEdApp(SoftwareApplication $edApp) {
        $this->edApp = $edApp;
        return $this;
    }

    /** @return Organization group */
    public function getGroup() {
        return $this->group;
    }

    /**
     * @param Organization $group
     * @return $this|Event
     */
    public function setGroup(\w3c\Organization $group) {
        $this->group = $group;
        return $this;
    }

    /** @return Membership membership */
    public function getMembership() {
        return $this->membership;
    }

    /**
     * @param Membership|object $membership
     * @return $this|Event
     */
    public function setMembership(Membership $membership) {
        $this->membership = $membership;
        return $this;
    }

    /** @return Session */
    public function getFederatedSession() {
        return $this->federatedSession;
    }

    /**
     * @param Session $federatedSession
     * @return $this|Event
     */
    public function setFederatedSession(Session $federatedSession) {
        $this->federatedSession = $federatedSession;
        return $this;
    }
}

