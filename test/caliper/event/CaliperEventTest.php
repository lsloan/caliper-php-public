<?php
require_once realpath(dirname(__FILE__) . '/../../../lib/CaliperSensor.php');
require_once 'Caliper/entities/reading/EPubVolume.php';
require_once 'Caliper/entities/lis/LISPerson.php';
require_once 'Caliper/entities/ActivityContext.php';

class CaliperEventTest extends PHPUnit_Framework_TestCase {

	private $caliperEvent;

	
	public function setUp()  {
        $theTime = new DateTime('2015-09-02T11:30:00.000Z');

		$caliperEvent = new CaliperEvent();
		$caliperEvent->setContext("http://purl.imsglobal.org/ctx/caliper/v1/NavigationEvent");		
		$caliperEvent->setType("NavigationEvent");
		$caliperEvent->setAction("navigate_to");
		
		$actor = new LISPerson("uri:/someEdu/user/42");
		$caliperEvent->setActor($actor);
		
		$activityContext = new ActivityContext();
		$activityContext->setId("uri:/someEdu/reading/42");
		$activityContext->setType("reading"); // TODO fix
		$caliperEvent->setObject($activityContext);
		
		$readiumReading = new EPubVolume("https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3)");
		$readiumReading->setName("The Glorious Cause: The American Revolution, 1763-1789 (Oxford History of the United States)");
		$readiumReading->setDateModified($theTime);
//		$readiumReading->setLanguage("English");
		
		$caliperEvent->setTarget($readiumReading);
		
		$caliperEvent->setStartedAtTime($theTime);
		
		$this->caliperEvent= $caliperEvent;
	}


	public function testcaliperEventSerializesToJSON(){

		 $this->assertJsonStringEqualsJsonFile(dirname(dirname(__FILE__)).'/../resources/fixtures/CaliperEvent.json',json_encode($this->caliperEvent,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
	}
}