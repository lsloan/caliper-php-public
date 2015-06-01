<?php
require_once realpath(dirname(__FILE__) . '/../../../lib/CaliperSensor.php');
require_once 'Caliper/entities/Entity.php';
require_once 'Caliper/events/Event.php';

/**
 * @requires PHP 5.4
 */
class ApiTest extends PHPUnit_Framework_TestCase {

    function setUp() {
        date_default_timezone_set('UTC');
        $this->markTestSkipped('Fix these tests to use a readily available server or setup/mock their own server');
        // $options["host"] = "localhost:8000";
        // Caliper::init("testapiKey", $options);
        Caliper::init("testapiKey");
    }

    /**
     * @group caliper
     */
    function testDescribe() {
    	$this->markTestSkipped('Fix this test to not instantiate abstract class Entity()');
        $caliperEntity = new Entity();
        $caliperEntity->setId("course-1234");
        $caliperEntity->setType("course");
        $caliperEntity->setProperties(array(
            "program" => "Engineering",
            "start-date" => time(),
        ));

        $described = Caliper::describe($caliperEntity);
        $this->assertTrue($described);
    }

    /**
     * @group caliper
     */
    function testSend() {
    	$this->markTestSkipped('Fix this test to not instantiate Event()');
        $caliperEvent = new Event();
        $caliperEvent->setAction("HILIGHT");
        $caliperEvent->setLearningContext(array(
            "courseId" => "course-1234",
            "userId" => "user-1234",
        ));

        $sent = Caliper::send($caliperEvent);
        $this->assertTrue($sent);
    }
}
