<?php

/**
 *  author: Prashant Nayak
 *  ©2013 IMS Global Learning Consortium, Inc.  All Rights Reserved.
 *  For license information contact, info@imsglobal.org
 */

require_once(dirname(__FILE__) . "/../../lib/Caliper.php");
require_once(dirname(__FILE__) . "/../../lib/Caliper/entities/CaliperEntity.php");
require_once(dirname(__FILE__) . "/../../lib/Caliper/events/CaliperEvent.php");

class CaliperCaliperTest extends PHPUnit_Framework_TestCase {

    function setUp() {
        // $options["host"] = "localhost:8000";
        // Caliper::init("testapiKey", $options);
        Caliper::init("testapiKey");
    }

    /**
     * @group caliper
     */
    function testDescribe() {
        $caliperEntity = new CaliperEntity();
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
    function testMeasure() {
        $caliperEvent = new CaliperEvent();
        $caliperEvent->setAction("HILIGHT");
        $caliperEvent->setLearningContext(array(
            "courseId" => "course-1234",
            "userId" => "user-1234",
        ));
        $caliperEvent->setActivityContext(array(
            "activityId" => "reading-1234",
            "pageId" => "page-1234",
        ));

        $measured = Caliper::measure($caliperEvent);
        $this->assertTrue($measured);
    }
}