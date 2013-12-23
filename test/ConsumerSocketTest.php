<?php

/**
 *  author: Prashant Nayak
 *  ©2013 IMS Global Learning Consortium, Inc.  All Rights Reserved.
 *  For license information contact, info@imsglobal.org
 */

require_once(dirname(__FILE__) . "/../lib/Caliper/Client.php");

class ConsumerSocketTest extends PHPUnit_Framework_TestCase {

  private $client;

  function setUp() {
    $this->client = new Caliper_Client("testApiKey",
                                          array("consumer" => "socket"));
  }

  function testTimeout() {
    $client = new Caliper_Client("testApiKey",
                                   array( "timeout"  => 0.01,
                                          "consumer" => "socket" ));

    $described = $client->describe("Course", "course-1234", array(
                    "program"    => "Engineering",
                    "start-date" => time(),
                    ));
    $this->assertTrue($described);

    $client->__destruct();
  }

  function testProd() {
    $client = new Caliper_Client("x", array(
        "consumer"      => "socket",
        "error_handler" => function () { throw new Exception("Was called"); }));

    # Shouldn't error out without debug on.
    $client->describe("Course", "course-1234", array(
                    "program"    => "Engineering",
                    "start-date" => time(),
                    ));
    $client->__destruct();
  }

  function testDebug() {

    $options = array(
      "debug"         => true,
      "consumer"      => "socket",
      "error_handler" => function ($errno, $errmsg) {
                            if ($errno != 400)
                              throw new Exception("Response is not 400"); }
    );

    $client = new Caliper_Client("x", $options);

    # Should error out with debug on.
    ## TODO - renable after fixing socket issues
    // $client->describe("Course", "course-1234", array(
    //                 "program"    => "Engineering",
    //                 "start-date" => time(),
    //                 ));
    $client->__destruct();
  }


  function testLargeMessage () {
    $options = array(
      "debug"    => true,
      "consumer" => "socket"
    );

    $client = new Caliper_Client("testApiKey", $options);

    $large_message_body = "";

    for ($i = 0; $i < 10000; $i++) {
      $large_message_body .= "a";
    }

    $client->describe("Course", "course-1234", array(
                    "program"    => "Engineering",
                    "start-date" => time(),
                    "big_property" => $large_message_body
                    ));

    $client->__destruct();
  }
}
?>