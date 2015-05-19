<?php
require_once 'Caliper/request/EnvelopeContext.php';
require_once 'util/TimestampUtil.php';

class Envelope implements JsonSerializable {
    private $context;
    private $sensor;
    private $sendTime;
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
            'data' => [$this->getData()],
        ];
    }

    /**
     * @return mixed
     */
    public function getContext() {
        return $this->context;
    }

    /**
     * @param mixed $context
     */
    public function setContext($context) {
        $this->context = $context;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSensor() {
        return $this->sensor;
    }

    /**
     * @param mixed $sensor
     */
    public function setSensor($sensor) {
        $this->sensor = $sensor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSendTime() {
        return $this->sendTime;
    }

    /**
     * @param mixed $sendTime
     * @return $this|Envelope
     */
    public function setSendTime($sendTime) {
        $this->sendTime = $sendTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData() {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data) {
        $this->data = $data;
        return $this;
    }
}