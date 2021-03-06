<?php
require_once realpath(dirname(__FILE__) . '/caliper/CaliperTestCase.php');
require_once 'Caliper/Client.php';

/**
 * These tests may require an eventstore endpoint
 *
 * @requires extension fix_these_tests
 * @requires PHP 5.4
 */
class ConsumerSocketTest extends PHPUnit_Framework_TestCase {

    private $client;

    private $caliperEntity;

    function setUp() {
        $this->client = new Client('testApiKey', [
            'consumer' => 'socket'
        ]);

        $this->caliperEntity = new Entity();
        $this->caliperEntity->setId('course-1234');
        $this->caliperEntity->setType('course');
        $this->caliperEntity->setProperties([
            'program' => 'Engineering',
            'start-date' => time()
        ]);
    }

    function testTimeout() {
        $client = new Client('testApiKey', [
            'timeout' => 0.01,
            'consumer' => 'socket'
        ]);


        $described = $client->describe($this->caliperEntity);
        echo '**********************************';
        echo $described;
        echo '**********************************';
        $this->assertTrue($described);

        $client->__destruct();
    }

    function testProd() {
        $client = new Client('x', [
            'consumer' => 'socket',
            'error_handler' => function () {
                throw new Exception('Was called');
            }]);

        # Shouldn't error out without debug on.
        $client->describe($this->caliperEntity);
        $client->__destruct();
    }

    function testDebug() {

        $options = [
            'debug' => true,
            'consumer' => 'socket',
            'error_handler' => function ($errno, $errmsg) {
                if ($errno != 400)
                    throw new Exception('Response is not 400');
            }
        ];

        $client = new Client('x', $options);

        # Should error out with debug on.
        ## TODO - renable after fixing socket issues
        // $clients->describe('Course', 'course-1234', [
        //                 'program'    => 'Engineering',
        //                 'start-date' => time(),
        //                 ));
        $client->__destruct();
    }


    function testLargeMessage() {
        $options = [
            'debug' => true,
            'consumer' => 'socket'
        ];

        $client = new Client('testApiKey', $options);

        $large_message_body = '';

        for ($i = 0; $i < 10000; $i++) {
            $large_message_body .= 'a';
        }

        $ce = new Entity();
        $ce->setId('course-1234');
        $ce->setType('course');
        $ce->setProperties([
            'program' => 'Engineering',
            'start-date' => time(),
            'big_property' => $large_message_body
        ]);

        $client->describe($ce);

        $client->__destruct();
    }
}

?>