<?php

abstract class QueueConsumer extends Consumer {
    protected $type = 'QueueConsumer';

    /**
     * Store apiKey and options as part of this consumer
     * @param string $apiKey
     * @param array $options
     */
    public function __construct($apiKey, $options = []) {
        parent::__construct($apiKey, $options);
    }

    /**
     * Send events
     * @param Event $event
     * @return bool success
     */
    public function send(Event $event) {
        return $this->flushSingleItem($event);
    }

    /**
     * Describe entities
     * @param Entity $entity
     * @return bool success
     */
    public function describe(Entity $entity) {
        return $this->flushSingleItem($entity);
    }

    /**
     * Flush a single item
     * @param  Entity|Event $item
     * @return bool success
     */
    abstract function flushSingleItem($item);
}
