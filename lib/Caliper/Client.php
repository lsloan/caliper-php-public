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
     * @param Event|Event[] $events
     */
    public function send(Sensor $sensor, $events) {
        if (!is_array($events)) {
            $events = [$events];
        }

        foreach ($events as $anEvent) {
            if (!($anEvent instanceof Event)) {
                throw new InvalidArgumentException(__METHOD__ . ': array of ' . Event::className() . ' expected');
            }
        }

        (new HttpRequestor($this->getOptions()))
            ->send($sensor, $events);
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
     * Describe an entities
     * @param Sensor $sensor
     * @param Entity|Entity[] $entities
     */
    public function describe($sensor, $entities) {
        if (!is_array($entities)) {
            $entities = [$entities];
        }

        foreach ($entities as $anEntity) {
            if (!($anEntity instanceof Entity)) {
                throw new InvalidArgumentException(__METHOD__ . ': array of ' . Entity::className() . ' expected');
            }
        }

        (new HttpRequestor($this->getOptions()))
            ->send($sensor, $entities);
    }
}
