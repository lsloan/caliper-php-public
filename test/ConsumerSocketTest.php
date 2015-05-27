<?php
require_once(dirname(__FILE__) . "/../lib/Caliper/Client.php");

/**
 * @requires PHP 5.4
 */
class ConsumerSocketTest extends PHPUnit_Framework_TestCase {

  private $client;
  
  private $caliperEntity;

  function setUp() {
    $this->client = new Caliper_Client("testApiKey",
                                          array("consumer" => "socket"));
    
    $this->caliperEntity = new Entity();
    $this->caliperEntity->setId("course-1234");
    $this->caliperEntity->setType("course");
    $this->caliperEntity->setProperties(array(
    		"program" => "Engineering",
    		"start-date" => time()
    ));
  }

  function testTimeout() {
    $client = new Caliper_Client("testApiKey",
                                   array( "timeout"  => 0.01,
                                          "consumer" => "socket" ));
    
   
    

    $described = $client->describe($this->caliperEntity);
    echo "**********************************";
    echo $described;
    echo "**********************************";
    $this->assertTrue($described);

    $client->__destruct();
  }

  function testProd() {
    $client = new Caliper_Client("x", array(
        "consumer"      => "socket",
        "error_handler" => function () { throw new Exception("Was called"); }));

    # Shouldn't error out without debug on.
    $client->describe($this->caliperEntity);
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
    
    $ce = new Entity();
    $ce->setId("course-1234");
    $ce->setType("course");
    $ce->setProperties(array(
    		"program" => "Engineering",
    		"start-date" => time(),
    		"big_property" => $large_message_body
    ));

    $client->describe($ce);

    $client->__destruct();
  }
}
?>