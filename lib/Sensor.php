<?php
define ('CALIPER_REQUIRED_PHP_VERSION', '5.4.0');
if (version_compare(PHP_VERSION, CALIPER_REQUIRED_PHP_VERSION, '<')) {
    throw new UnexpectedValueException('Sensor requires PHP ' .
        CALIPER_REQUIRED_PHP_VERSION . ' or greater.  This is version: ' . PHP_VERSION);
}

if (!extension_loaded('http')) {
    throw new Exception('Sensor requires the PHP "http" extension.');
}

if (!extension_loaded('json')) {
    throw new Exception('Sensor requires the PHP "json" extension.');
}

define('CALIPER_LIB_PATH', realpath(dirname(__FILE__)));
set_include_path(get_include_path() . PATH_SEPARATOR . CALIPER_LIB_PATH);

require_once 'Caliper/Client.php';
require_once 'Caliper/events/Event.php';
require_once 'Caliper/entities/Entity.php';

class Sensor {
    /** @var Client[] */
    private $clients;
    /** @var string */
    private $id;

    /** @param string $id */
    public function __construct($id) {
        if (!is_string($id)) {
            throw new InvalidArgumentException(__METHOD__ . ': string expected');
        }

        $this->setId($id);
    }

    /** @return string id */
    public function getId() {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this|Sensor
     */
    public function setId($id) {
        if (! is_string($id)) {
            throw new InvalidArgumentException(__METHOD__ . ': string expected');
        }

        $this->id = $id;
        return $this;
    }

    /**
     * @param string $key
     * @param Client $client
     * @return $this|Sensor
     */
    public function registerClient($key, Client $client) {
        if (!is_string($key)) {
            throw new InvalidArgumentException(__METHOD__ . ': string expected');
        }

        $this->clients[$key] = $client;
        return $this;
    }

    /**
     * @param string $key
     * @return $this|Sensor
     */
    public function unregisterClient($key) {
        if (!is_string($key)) {
            throw new InvalidArgumentException(__METHOD__ . ': string expected');
        }

        unset($this->clients[$key]);
        return $this;
    }

    /**
     * Send learning events
     * @param Sensor $sensor
     * @param Event|Event[] $events
     */
    public function send(Sensor $sensor, $events) {
        $this->checkClients();

        if (!is_array($events)) {
            $events = [$events];
        }

        foreach ($events as $anEvent) {
            if (!($anEvent instanceof Event)) {
                throw new InvalidArgumentException(__METHOD__ . ': array of ' . Event::class . ' expected');
            }
        }

        foreach ($this->clients as $client) {
            $client->send($sensor, $events);
        }
    }

    /**
     * Ensures that some clients are set. Throws an exception when not set.
     */
    private function checkClients() {
        if ($this->clients == null) {
            throw new RuntimeException(
                'registerClient() must be called before describe() or send()'
            );
        }
    }

    /**
     * Describe entities
     * @param Sensor $sensor
     * @param Entity|Entity[] $entities
     */
    public function describe(Sensor $sensor, $entities) {
        $this->checkClients();

        if (!is_array($entities)) {
            $entities = [$entities];
        }

        foreach ($entities as $anEntity) {
            if (!($anEntity instanceof Entity)) {
                throw new InvalidArgumentException(__METHOD__ . ': array of ' . Entity::class . ' expected');
            }
        }

        foreach ($this->clients as $client) {
            $client->describe($sensor, $entities);
        }
    }
}
