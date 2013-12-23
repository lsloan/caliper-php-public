<?php

/**
 *  author: Prashant Nayak
 *  ©2013 IMS Global Learning Consortium, Inc.  All Rights Reserved.
 *  For license information contact, info@imsglobal.org
 */

require_once(dirname(__FILE__) . "/../../lib/Caliper.php");

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
    $described = Caliper::describe("Course", "course-1234", array(
                    "program"    => "Engineering",
                    "start-date" => time(),
                    ));
    $this->assertTrue($described);
  }

  /**
   * @group caliper
  */
  function testMeasure() {
    $described = Caliper::measure("HILIGHT", array(
                    "courseId" => "course-1234",
                    "userId"   => "user-1234",
                    ), array(
                    "activityId" => "reading-1234",
                    "pageId"     => "page-1234",
                    ));
    $this->assertTrue($described);
  }
}
?>