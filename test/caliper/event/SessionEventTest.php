<?php
$caliperLibDir = dirname(dirname(dirname(dirname(__FILE__)))) . '/lib/';

require_once($caliperLibDir . 'CaliperSensor.php');
require_once($caliperLibDir . 'Caliper/entities/CaliperDigitalResource.php');
require_once($caliperLibDir . 'Caliper/entities/reading/EPubVolume.php');
require_once($caliperLibDir . 'Caliper/entities/reading/EPubSubChapter.php');
require_once($caliperLibDir . 'Caliper/entities/lis/LISCourseSection.php');
require_once($caliperLibDir . 'Caliper/entities/lis/LISOrganization.php');
require_once($caliperLibDir . 'Caliper/entities/lis/LISPerson.php');
require_once($caliperLibDir . 'Caliper/entities/SoftwareApplication.php');
require_once($caliperLibDir . 'Caliper/events/reading/SessionEvent.php');
require_once($caliperLibDir . 'Caliper/entities/schemadotorg/WebPage.php');


class SessionEventTest extends PHPUnit_Framework_TestCase {
	private $sessionEvent;
	
	function setUp() {
		$testTime = 1402965614516;

		$actor = new LISPerson('https://some-university.edu/user/554433');
		$actor->setLastModifiedAt($testTime);

		// TODO replace with value from SessionProfile::Actions
		$action = 'session.loggedIn';

		$eventObj = new SoftwareApplication('https://github.com/readium/readium-js-viewer');
		$eventObj->setName('Readium');
		// TODO remove this setType?  it's from original ViewedEventTest.php
		$eventObj->setType('http://purl.imsglobal.org/ctx/caliper/v1/edApp/epub-reader');
		$eventObj->setLastModifiedAt($testTime);

		$ePubVolume = new EPubVolume('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3)');	
		$ePubVolume->setResourceType('EPUB_VOLUME');
		$ePubVolume->setName('The Glorious Cause: The American Revolution, 1763-1789 (Oxford History of the United States)');
		$ePubVolume->setLastModifiedAt($testTime);
		// TODO remove this setLanguage?  it's from original ViewedEventTest.php
		$ePubVolume->setLanguage('English');

		// TODO Implement Frame.  JS test uses Frame.  PHP library doesn't have it.
		$targetObj = new EPubSubChapter('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3/1)');
		$targetObj->setResourceType('FRAME');
		$targetObj->setName('Key Figures: George Washington)');
		$targetObj->setLastModifiedAt($testTime);
		// TODO remove this setLanguage?  it's from original ViewedEventTest.php
		$targetObj->setLanguage('English');
		$targetObj->setIndex(1);
		$targetObj->setPartOf($ePubVolume); // $targetObj->setParentRef($ePubVolume);

		$generatedObj = new Session('https://github.com/readium/session-123456789');
		$generatedObj->setName('session-123456789');
		$generatedObj->setStartedAtTime($testTime);
		$generatedObj->setEndedAtTime(0);
		$generatedObj->setDuration(null);
		$generatedObj->setLastModifiedTime($testTime);

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
	 	$this->assertJsonStringEqualsJsonFile(dirname($caliperLibDir).'/../resources/fixtures/SessionEvent.json',json_encode($this->sessionEvent,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
	 }
}
