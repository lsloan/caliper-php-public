<?php
require_once __DIR__ . '/Consumer.php';
require_once __DIR__ . '/QueueConsumer.php';
require_once 'Caliper/request/Envelope.php';
require_once __DIR__ . '/Consumer/SocketConsumer.php';
require_once __DIR__ . '/events/Event.php';
require_once __DIR__ . '/entities/Entity.php';

class Caliper_Client {
    private $consumer;

    /**
     * Create a new client object
     *
     * @param string $apiKey
     * @param array $options array of consumer options [optional]
     */
    public function __construct($apiKey, $options = array()) {

        $consumers = array(
            "socket" => "SocketConsumer"
        );

        # Use our socket consumer by default, add other consumers as needed above
        $consumer_type = isset($options["consumer"]) ? $options["consumer"] :
            "socket";
        $Consumer = $consumers[$consumer_type];

        $this->consumer = new $Consumer($apiKey, $options);
    }

    /**
     * Send learning events
     * @param  Event $caliperEvent A Caliper event object
     * @return boolean success
     */
    public function send($caliperEvent) {
        return $this->consumer->send($caliperEvent);
    }

    /**
     * Describe an entity
     * @param  Entity $caliperEntity The Caliper Entity we are describing
     * @return boolean whether the describe call succeeded
     */
    public function describe($caliperEntity) {
        return $this->consumer->describe($caliperEntity);
    }
}
