<?php
require_once 'Caliper/request/EnvelopeContext.php';
require_once 'util/TimestampUtil.php';

class Envelope implements JsonSerializable {
    /** @var EventContext */
    private $context;
    /** @var string */
    private $sensor;
    /** @var DateTime */
    private $sendTime;
    /** @var object[] */
    private $data;

    public function __construct($sensor = null, $data = null) {
        $this->setContext(EnvelopeContext::CONTEXT)
            ->setSensor($sensor)
            ->setSendTime(new DateTime())
            ->setData($data);
    }

    public function jsonSerialize() {
        return [
            '@context' => $this->getContext(),
            'sensor' => $this->getSensor(),
            'sendTime' => TimestampUtil::formatTimeISO8601MillisUTC($this->getSendTime()),
            'data' => $this->getData(),
        ];
    }

    /** @return EventContext context */
    public function getContext() {
        return $this->context;
    }

    /**
     * @param EventContext $context
     * @return $this|Envelope
     */
    public function setContext($context) {
        $this->context = $context;
        return $this;
    }

    /** @return string sensor */
    public function getSensor() {
        return $this->sensor;
    }

    /**
     * @param string $sensor
     * @return $this|Envelope
     */
    public function setSensor($sensor) {
        $this->sensor = $sensor;
        return $this;
    }

    /** @return DateTime sendTime */
    public function getSendTime() {
        return $this->sendTime;
    }

    /**
     * @param DateTime $sendTime
     * @return $this|Envelope
     */
    public function setSendTime($sendTime) {
        $this->sendTime = $sendTime;
        return $this;
    }

    /** @return object[] data */
    public function getData() {
        return $this->data;
    }

    /**
     * @param object[]|object $data
     * @return $this|Envelope
     */
    public function setData($data) {
        if (!is_array($data)) {
            $data = [$data];
        }

        $this->data = $data;
        return $this;
    }
}

