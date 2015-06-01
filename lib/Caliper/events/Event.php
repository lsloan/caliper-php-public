<?php
require_once 'Caliper/context/Context.php';
require_once 'util/TimestampUtil.php';

abstract class Event implements JsonSerializable {
    /** @var Context */
    private $context;
    /** @var EventType */
    private $type;
    /** @var Agent */
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
        $this->setContext(Context::CONTEXT);
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
            'federatedSession' => $this->getFederatedSession(),
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
    public function setContext($context) {
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
    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    /** @return Agent actor */
    public function getActor() {
        return $this->actor;
    }

    /**
     * @param Agent $actor
     * @return $this|Event
     */
    public function setActor($actor) {
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
    public function setAction($action) {
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
    public function setTarget($target) {
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
    public function setGenerated($generated) {
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
     * @return $this|Event
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
     * @param int $duration
     * @return $this|Event
     */
    public function setDuration($duration) {
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
    public function setEdApp($edApp) {
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
    public function setGroup($group) {
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
    public function setMembership($membership) {
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
    public function setFederatedSession($federatedSession) {
        $this->federatedSession = $federatedSession;
        return $this;
    }
}

