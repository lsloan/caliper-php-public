<?php
require_once realpath(dirname(__FILE__) . '/../../../lib/CaliperSensor.php');
require_once 'Caliper/entities/reading/EPubVolume.php';
require_once 'Caliper/entities/reading/EPubSubChapter.php';
require_once 'Caliper/entities/lis/LISPerson.php';
require_once 'Caliper/entities/lis/LISCourseSection.php';
require_once 'Caliper/entities/SoftwareApplication.php';
require_once 'Caliper/entities/Session.php';
require_once 'Caliper/events/SessionEvent.php';
require_once 'Caliper/actions/SessionActions.php';

class SessionTimeoutEventTest extends PHPUnit_Framework_TestCase {
	private $sessionEvent;
	
	function setUp() {
		$createdTime = new DateTime('2015-01-01T06:00:00Z');
		$modifiedTime = new DateTime('2015-02-02T11:30:00Z');

        $sessionStartTime = new DateTime('2015-02-15T10:15:00.000Z');
        $sessionEndTime = new DateTime('2015-02-15T11:05:00.000Z');
        $sessionDurationSeconds = $sessionEndTime->getTimestamp() - $sessionStartTime->getTimestamp();

        $testPerson = new LISPerson('https://some-university.edu/user/554433');
		$testPerson->setDateCreated($createdTime);
		$testPerson->setDateModified($modifiedTime);

		$eventObj = new SoftwareApplication('https://github.com/readium/readium-js-viewer');
		$eventObj->setName('Readium');
		$eventObj->setDateCreated($createdTime);
		$eventObj->setDateModified($modifiedTime);

		$ePubVolume = new EPubVolume('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3)');	
		$ePubVolume->setType('http://www.idpf.org/epub/vocab/structure/#volume');
		$ePubVolume->setName('The Glorious Cause: The American Revolution, 1763-1789 (Oxford History of the United States)');
		$ePubVolume->setDateCreated($createdTime);
		$ePubVolume->setDateModified($modifiedTime);

		$targetObj = new Session('https://github.com/readium/session-123456789');
		$targetObj->setName('session-123456789');
		$targetObj->setDateCreated($createdTime);
		$targetObj->setDateModified($modifiedTime);
		$targetObj->setActor($testPerson);
		$targetObj->setStartedAtTime($sessionStartTime);
		$targetObj->setEndedAtTime($sessionEndTime);
        $targetObj->setDuration($sessionDurationSeconds);

		$organization = new LISCourseSection('https://some-university.edu/politicalScience/2014/american-revolution-101');
		$organization->setSemester('Spring-2014');
		$organization->setCourseNumber('AmRev-101');
		$organization->setLabel('Am Rev 101');
		$organization->setName('American Revolution 101');
		$organization->setDateCreated($createdTime);
		$organization->setDateModified($modifiedTime);

		$sessionEvent = new SessionEvent();	
		$sessionEvent->setActor($eventObj);
		$sessionEvent->setAction(SessionActions::TIMED_OUT);
		$sessionEvent->setObject($eventObj);
		$sessionEvent->setTarget($targetObj);
		$sessionEvent->setEdApp($eventObj);
		$sessionEvent->setLisOrganization($organization);
		$sessionEvent->setStartedAtTime($sessionStartTime);
		$sessionEvent->setEndedAtTime($sessionEndTime);
        $sessionEvent->setDuration($sessionDurationSeconds);

		$this->sessionEvent = $sessionEvent;
	}
	
	function testSessionEventSerializesToJSON() {
		$sessionEventJson = json_encode($this->sessionEvent, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
		$testFixtureFilePath = realpath(CALIPER_LIB_PATH . '/../../caliper-common-fixtures/src/test/resources/fixtures/caliperSessionTimeoutEvent.json');

        $outputDir = getenv('PHPUNIT_OUTPUT_DIR');
        if ($outputDir != FALSE) {
            file_put_contents(realpath($outputDir) . DIRECTORY_SEPARATOR . __CLASS__ . '.json', $sessionEventJson);
        }

		$this->assertJsonStringEqualsJsonFile($testFixtureFilePath, $sessionEventJson);
	}
}
