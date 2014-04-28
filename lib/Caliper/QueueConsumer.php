<?php

/**
 *  author: Prashant Nayak
 *  ©2013 IMS Global Learning Consortium, Inc.  All Rights Reserved.
 *  For license information contact, info@imsglobal.org
 */

abstract class Caliper_QueueConsumer extends Caliper_Consumer {

  protected $type = "QueueConsumer";

  protected $queue;
  protected $max_queue_size = 1000;
  protected $batch_size = 100;

  /**
   * Store  apiKey and options as part of this consumer
   * @param string $apiKey
   * @param array  $options
   */
  public function __construct($apiKey, $options = array()) {
    parent::__construct($apiKey, $options);

    if (isset($options["max_queue_size"]))
      $this->max_queue_size = $options["max_queue_size"];

    if (isset($options["batch_size"]))
      $this->batch_size = $options["batch_size"];

    $this->queue = array();
  }

  public function __destruct() {
    # Nothing to do at this tim on destruction
  }

  /**
   * Describe an entity 
   * @param  string $type       the type of the entity (e.g. Course, Person)
   * @param  string $entity_id  id of the entity as known by the source system
   * @param  array  $properties properties associated with the entity 
   * @param  number $timestamp  unix seconds since epoch (time()) [optional]
   * @return boolean whether the track call succeeded
   */
  public function describe($type, $entity_id, $properties, $timestamp) {

    $body = array(
      "apiKey"     => $this->apiKey,
      "type"       => $type,
      "entityId"   => $entity_id,
      "properties" => $properties,
      "timestamp"  => $timestamp,
      "__action"   => "describe",
      "il_sensorId" => $this->options["sensor_id"]
    );

    return $this->enqueue($body);
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

    $body = array(
      "apiKey"            => $this->apiKey,
      "action"            => $action,
      "learningContext"  => $learning_context,
      "activityContext"  => $activity_context,
      "timestamp"         => $timestamp,
      "__action"          => "measure",
      "il_sensorId" => $this->options["sensor_id"]
    );

    return $this->enqueue($body);
  }

  /**
   * Enqueues and item for sending to server
   * @param  mixed   $item
   * @return boolean success status
   */
  protected function enqueue($item) {

    //TODO - implement a better queue

    $is_describe = $item["__action"];
    if (isset($is_describe) && $is_describe == "describe") {
      //print("processing DESCRIBE");
      $this->flushSingleDescribe($item);
      return true;
    }

    $is_measure = $item["__action"];
    if (isset($is_measure) && $is_measure == "measure") {
      //print("processing MEASURE");
      $this->flushSingleMeasure($item);
      return true;
    }
  }

  /**
   * Flushes a single describe
   * @param  [type] $item  [description]
   * @return [type]        [description]
   */
  abstract function flushSingleDescribe($item);

  /**
   * Flushes a single measure
   * @param  [type] $item  [description]
   * @return [type]        [description]
   */
  abstract function flushSingleMeasure($item);
}
