<?php

/**
 *  ©2013 IMS Global Learning Consortium, Inc.  All Rights Reserved.
 *  For license information contact, info@imsglobal.org
 */

if (!function_exists('json_encode')) {
    throw new Exception('Caliper needs the JSON PHP extension.');
}

define('CALIPER_LIB_PATH', realpath(dirname(__FILE__)));
set_include_path(get_include_path() . PATH_SEPARATOR . CALIPER_LIB_PATH);

require_once 'Caliper/Client.php';
require_once 'Caliper/events/CaliperEvent.php';
require_once 'Caliper/entities/CaliperEntity.php';

class Caliper {

    private static $client;

    /**
     * Initializes the default client to use. Uses the socket consumer by default.
     * @param  string $apiKey your project's apiKey key
     * @param  array $options passed straight to the client
     */
    public static function init($apiKey, $options = array()) {

        if (!$apiKey) {
            throw new Exception("Caliper::init Secret parameter is required");
        }

        self::$client = new Caliper_Client($apiKey, $options);
    }

    /**
     * Send learning events
     * @param  CaliperEvent $caliperEvent The Caliper Event
     * @return boolean                   whether the measure call succeeded
     */
    public static function measure($caliperEvent) {
        self::check_client();
        return self::$client->measure($caliperEvent);
    }

    /**
     * Describe an entity
     * @param  CaliperEntity $caliperEntity The Caliper Entity we are describing
     * @return boolean            whether the describe call succeeded
     */
    public static function describe($caliperEntity) {
        self::check_client();
        return self::$client->describe($caliperEntity);
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
