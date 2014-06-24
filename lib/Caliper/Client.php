<?php

/**
 *  author: Prashant Nayak
 *  ©2013 IMS Global Learning Consortium, Inc.  All Rights Reserved.
 *  For license information contact, info@imsglobal.org
 */

require(__DIR__ . '/Consumer.php');
require(__DIR__ . '/QueueConsumer.php');
require(__DIR__ . '/Consumer/Socket.php');
require(__DIR__ . '/events/CaliperEvent.php');
require(__DIR__ . '/entities/CaliperEntity.php');

class Caliper_Client {

    private $consumer;

    /**
     * Create a new client object
     *
     * @param string $apiKey
     * @param array $options array of consumer options [optional]
     * @param string Consumer constructor to use, socket by default.
     */
    public function __construct($apiKey, $options = array()) {

        $consumers = array(
            "socket" => "Caliper_Consumer_Socket"
        );

        # Use our socket consumer by default, add other consumers as needed above
        $consumer_type = isset($options["consumer"]) ? $options["consumer"] :
            "socket";
        $Consumer = $consumers[$consumer_type];

        $this->consumer = new $Consumer($apiKey, $options);
    }

    public function __destruct() {
        $this->consumer->__destruct();
    }

    /**
     * Send learning events
     * @param  CaliperEvent $caliperEvent The Caliper Event
     * @return boolean whether the measure call succeeded
     */
    public function measure($caliperEvent, $timestamp=null) {

        $timestamp = $this->formatTime($caliperEvent->getStartedAt());
        $action = $caliperEvent->getAction();
        $learning_context = $caliperEvent->getLearningContext();
        $activity_context = $caliperEvent->getActivityContext();

        // json_encode will serialize as []
        if (count($learning_context) == 0) {
            $learning_context = null;
        }
        if (count($activity_context) == 0) {
            $activity_context = null;
        }

        return $this->consumer->measure($action, $learning_context, $activity_context, $timestamp);
    }

    /**
     * Describe an entity
     * @param  CaliperEntity $caliperEntity The Caliper Entity we are describing
     * @return boolean whether the describe call succeeded
     */
    public function describe($caliperEntity, $timestamp = null) {

        $timestamp = $this->formatTime($timestamp);
        $entity_id = $caliperEntity->getId();
        $type = $caliperEntity->getType();
        $properties = $caliperEntity->getProperties();

        // json_encode will serialize as []
        if (count($properties) == 0) {
            $properties = null;
        }

        return $this->consumer->describe($type, $entity_id, $properties, $timestamp);
    }

    /**
     * Formats a timestamp by making sure it is set, and then converting it to
     * iso8601 format.
     * @param  time $timestamp - time in seconds (time())
     */
    private function formatTime($timestamp) {

        if ($timestamp == null) $timestamp = time();

        # Format for iso8601
        #return date("c", $timestamp);
        return $timestamp;
    }
}
