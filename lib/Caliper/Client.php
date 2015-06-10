<?php
require_once 'Caliper/events/Event.php';
require_once 'Caliper/entities/Entity.php';
require_once 'Caliper/request/HttpRequestor.php';

class Client {
    /** @var string */
    private $id;
    /** @var Options */
    private $options;

    /**
     * @param string $id
     * @param Options $options
     */
    public function __construct($id, Options $options) {
        $this->setId($id)
            ->setOptions($options);
    }

    /** @return string id */
    public function getId() {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this|Client
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Send application events
     * @param Sensor $sensor
     * @param Event $event
     */
    public function send(Sensor $sensor, $event) {
        (new HttpRequestor($this->getOptions()))
            ->send($sensor, $event);
    }

    /** @return Options options */
    public function getOptions() {
        return $this->options;
    }

    /**
     * @param Options $options
     * @return $this|Client
     */
    public function setOptions($options) {
        $this->options = $options;
        return $this;
    }

    /**
     * Describe an entity
     * @param Sensor $sensor
     * @param Entity $entity
     */
    public function describe($sensor, $entity) {
        (new HttpRequestor($this->getOptions()))
            ->send($sensor, $entity);
    }
}
