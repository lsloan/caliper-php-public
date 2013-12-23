<?php

/**
 *  author: Prashant Nayak
 *  ©2013 IMS Global Learning Consortium, Inc.  All Rights Reserved.
 *  For license information contact, info@imsglobal.org
 */

if (!function_exists('json_encode')) {
    throw new Exception('Caliper needs the JSON PHP extension.');
}

require_once(dirname(__FILE__) . '/Caliper/Client.php');


class Caliper {

  private static $client;

  /**
   * Initializes the default client to use. Uses the socket consumer by default.
   * @param  string $apiKey   your project's apiKey key
   * @param  array  $options  passed straight to the client
   */
  public static function init($apiKey, $options = array()) {

  	if (!$apiKey){
  		throw new Exception("Caliper::init Secret parameter is required");
  	}

    self::$client = new Caliper_Client($apiKey, $options);
  }

  /**
   * Describe an entity 
   * @param  string $type       the type of the entity (e.g. Course, Person)
   * @param  string $entity_id  id of the entity as known by the source system
   * @param  array  $properties properties associated with the entity 
   * @param  number $timestamp  unix seconds since epoch (time()) [optional]
   * @return boolean            whether the describe call succeeded
   */
  public static function describe($type, $entity_id, $properties = null, $timestamp = null) {
    self::check_client();
    return self::$client->describe($type, $entity_id, $properties, $timestamp);
  }

  /**
   * Send learning events
   * @param  string $action            the action (from an Activity metric profile)
   * @param  string $learning_context  the learning context for the event
   * @param  array  $activity_context  the activity context for the event 
   * @param  number $timestamp         unix seconds since epoch (time()) [optional]
   * @return boolean                   whether the measure call succeeded
   */
  public static function measure($action, $learning_context = null, $activity_context = null, $timestamp = null) {
    self::check_client();
    return self::$client->measure($action, $learning_context, $activity_context, $timestamp);
  }

  /**
   * Ensures that the client is indeed set. Throws an exception when not set.
   */
  private static function check_client() {

    if (self::$client == null) {
      throw new Exception("Caliper::init must be called " .
                          "before describe, measure, track or identify");
    }
  }
}
