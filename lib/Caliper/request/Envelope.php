<?php
require_once 'Caliper/context/Context.php';
require_once 'util/TimestampUtil.php';

class Envelope implements JsonSerializable {
    /** @var Context */
    private $context;
    /** @var string */
    private $sensor;
    /** @var DateTime */
    private $sendTime;
    /** @var object[] */
    private $data;

    public function __construct($sensor = null, $data = null) {
        $this->setContext(new Context(Context::CONTEXT))
            ->setSendTime(new DateTime());
    }

    public function jsonSerialize() {
        return [
            '@context' => $this->getContext(),
            'sensor' => $this->getSensor(),
            'sendTime' => TimestampUtil::formatTimeISO8601MillisUTC($this->getSendTime()),
            'data' => $this->getData(),
        ];
    }

    /** @return Context context */
    public function getContext() {
        return $this->context;
    }

    /**
     * @param Context $context
     * @return $this|Envelope
     */
    public function setContext(Context $context) {
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
        if (!is_string($sensor)) {
            throw new InvalidArgumentException(__METHOD__ . ': string expected');
        }

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
    public function setSendTime(DateTime $sendTime) {
        $this->sendTime = $sendTime;
        return $this;
    }

    /** @return object[] data */
    public function getData() {
        return $this->data;
    }

    /**
     * @param object|object[] $data
     * @return $this|Envelope
     */
    public function setData($data) {
        if (!is_array($data)) {
            $data = [$data];
        }

        foreach ($data as $aData) {
            if (!is_object($aData)) {
                throw new InvalidArgumentException(__METHOD__ . ': object expected');
            }
        }

        $this->data = $data;
        return $this;
    }
}

