<?php

/**
 *  author: Prashant Nayak
 *  ©2013 IMS Global Learning Consortium, Inc.  All Rights Reserved.
 *  For license information contact, info@imsglobal.org
 */

require(__DIR__ . '/Consumer.php');
require(__DIR__ . '/QueueConsumer.php');
require(__DIR__ . '/Consumer/Socket.php');

class Caliper_Client {

  private $consumer;

  /**
   * Create a new client object 
   *
   * @param string $apiKey
   * @param array  $options array of consumer options [optional]
   * @param string Consumer constructor to use, socket by default.
   */
  public function __construct($apiKey, $options = array()) {

    $consumers = array(
      "socket"     => "Caliper_Consumer_Socket"
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
   * Describe an entity 
   * @param  string $type       the type of the entity (e.g. Course, Person)
   * @param  string $entity_id  id of the entity as known by the source system
   * @param  array  $properties properties associated with the entity 
   * @param  number $timestamp  unix seconds since epoch (time()) [optional]
   * @return boolean whether the track call succeeded
   */
  public function describe($type, $entity_id, $properties = null,
                                $timestamp = null) {

    $timestamp = $this->formatTime($timestamp);

    // json_encode will serialize as []
    if (count($properties) == 0) {
      $properties = null;
    }

    return $this->consumer->describe($type, $entity_id, $properties, $timestamp);
  }

  /**
   * Send learning events
   * @param  string $action            the action (from an Activity metric profile)
   * @param  string $learning_context  the learning context for the event
   * @param  array  $activity_context  the activity context for the event 
   * @param  number $timestamp         unix seconds since epoch (time()) [optional]
   * @return boolean                   whether the measure call succeeded
   */
  public function measure($action, $learning_context, $activity_context, $timestamp) {

    $timestamp = $this->formatTime($timestamp);

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
