<?php
define ('CALIPER_REQUIRED_PHP_VERSION', '5.4.0');
if (version_compare(PHP_VERSION, CALIPER_REQUIRED_PHP_VERSION, '<')) {
    throw new UnexpectedValueException('Caliper requires PHP ' .
        CALIPER_REQUIRED_PHP_VERSION . ' or greater.  This is version: ' . PHP_VERSION);
}

if (!extension_loaded('http')) {
    throw new Exception('Caliper requires the PHP "http" extension.');
}

if (!extension_loaded('json')) {
    throw new Exception('Caliper requires the PHP "json" extension.');
}

define('CALIPER_LIB_PATH', realpath(dirname(__FILE__)));
set_include_path(get_include_path() . PATH_SEPARATOR . CALIPER_LIB_PATH);

require_once 'Caliper/Client.php';
require_once 'Caliper/events/Event.php';
require_once 'Caliper/entities/Entity.php';

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
     * @param  Event $caliperEvent The Caliper Event
     * @return boolean success
     */
    public static function send($caliperEvent) {
        self::check_client();
        return self::$client->send($caliperEvent);
    }

    /**
     * Describe an entity
     * @param  Entity $caliperEntity The Caliper Entity we are describing
     * @return boolean success
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
                "before describe, send, track or identify");
        }
    }
}
