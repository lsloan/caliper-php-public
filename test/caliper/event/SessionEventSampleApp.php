<?php
$caliperLibDir = dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR;

require_once($caliperLibDir . 'CaliperSensor.php');
require_once($caliperLibDir . 'Caliper/entities/reading/EPubVolume.php');
require_once($caliperLibDir . 'Caliper/entities/reading/EPubSubChapter.php');
require_once($caliperLibDir . 'Caliper/entities/lis/LISPerson.php');
require_once($caliperLibDir . 'Caliper/entities/SoftwareApplication.php');
require_once($caliperLibDir . 'Caliper/entities/Session.php');
require_once($caliperLibDir . 'Caliper/events/reading/SessionEvent.php');
require_once($caliperLibDir . 'Caliper/actions/SessionActions.php');

class SessionEventSampleApp {
	private $sessionEvent;
	
	function setUp() {
		$testTime = 1402965614516;

		$actor = new LISPerson('https://some-university.edu/user/554433');
		$actor->setLastModifiedAt($testTime);

		$action = SessionActions::LOGGED_IN;

		$eventObj = new SoftwareApplication('https://github.com/readium/readium-js-viewer');
		$eventObj->setName('Readium');
		// TODO remove this setType?  it's from original ViewedEventTest.php
		$eventObj->setType('http://purl.imsglobal.org/caliper/v1/SoftwareApplication');
		$eventObj->setLastModifiedAt($testTime);

		$ePubVolume = new EPubVolume('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3)');	
		$ePubVolume->setType('http://www.idpf.org/epub/vocab/structure/#volume');
		$ePubVolume->setName('The Glorious Cause: The American Revolution, 1763-1789 (Oxford History of the United States)');
		$ePubVolume->setLastModifiedAt($testTime);

		// TODO Implement Frame.  JS test uses Frame.  PHP library doesn't have it.
		$targetObj = new EPubSubChapter('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3/1)');
		$targetObj->setType('http://purl.imsglobal.org/caliper/v1/Frame');
		$targetObj->setName('Key Figures: George Washington');
		$targetObj->setLastModifiedAt($testTime);
		$targetObj->setParentRef($ePubVolume);
		$targetObj->setIndex(1);

		$generatedObj = new Session('https://github.com/readium/session-123456789');
		$generatedObj->setName('session-123456789');
		$generatedObj->setStartedAtTime($testTime);
		$generatedObj->setEndedAtTime(0);
		$generatedObj->setDuration(null);
		$generatedObj->setLastModifiedAt($testTime);

		$edApp = null;
		$org = null;

		$sessionEvent = new SessionEvent();	
		$sessionEvent->setActor($actor);
		$sessionEvent->setAction($action);
		$sessionEvent->setObject($eventObj);
		$sessionEvent->setTarget($targetObj);
		$sessionEvent->setGenerated($generatedObj);
		$sessionEvent->setEdApp($edApp);
		$sessionEvent->setLisOrganization($org);
		$sessionEvent->setStartedAt($testTime);		

		$this->sessionEvent = $sessionEvent;
	}
	
	 function testSessionEventSerializesToJSON() {	
	 	return json_encode($this->sessionEvent,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
	 }
}

$sessionTest = new SessionEventSampleApp();
$sessionTest->setUp();
echo $sessionTest->testSessionEventSerializesToJSON() . PHP_EOL;
