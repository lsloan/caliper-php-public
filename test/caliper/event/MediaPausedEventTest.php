<?php
require_once realpath(dirname(__FILE__) . '/../../../lib/CaliperSensor.php');
require_once 'Caliper/actions/MediaActions.php';
require_once 'Caliper/events/MediaEvent.php';
require_once 'Caliper/entities/lis/LISPerson.php';
require_once 'Caliper/entities/lis/LISCourseSection.php';
require_once 'Caliper/entities/SoftwareApplication.php';
require_once 'Caliper/entities/media/MediaLocation.php';
require_once 'Caliper/entities/media/VideoObject.php';
require_once 'Caliper/entities/LearningObjective.php';

class MediaPausedEventTest extends PHPUnit_Framework_TestCase {
	private $mediaEvent;
	
	function setUp() {
		$createdTime = new DateTime('2015-01-01T06:00:00.000Z');
		$modifiedTime = new DateTime('2015-02-02T11:30:00.000Z');

		$sessionStartTime = new DateTime('2015-02-15T10:15:00.000Z');

		$testPerson = new LISPerson('https://some-university.edu/user/554433');
		$testPerson->setDateCreated($createdTime);
		$testPerson->setDateModified($modifiedTime);

		$application = new SoftwareApplication('https://com.sat/super-media-tool');
		$application->setName('Super Media Tool');
		$application->setDateCreated($createdTime);
		$application->setDateModified($modifiedTime);

		$organization = new LISCourseSection('https://some-university.edu/politicalScience/2014/american-revolution-101');
		$organization->setSemester('Spring-2014');
		$organization->setCourseNumber('AmRev-101');
		$organization->setLabel('Am Rev 101');
		$organization->setName('American Revolution 101');
		$organization->setDateCreated($createdTime);
		$organization->setDateModified($modifiedTime);

		$alignedLearningObjective = new LearningObjective('http://americanrevolution.com/personalities/learn');
		$alignedLearningObjective->setDateCreated($createdTime);

		$eventObj = new VideoObject('https://com.sat/super-media-tool/video/video1');
		$eventObj->setName('American Revolution - Key Figures Video');
		$eventObj->setAlignedLearningObjectives([$alignedLearningObjective]);
		$eventObj->setDateCreated($createdTime);
		$eventObj->setDateModified($modifiedTime);
		$eventObj->setDuration(1420);

		$targetObj = new MediaLocation('https://com.sat/super-media-tool/video/video1');
		$targetObj->setDateCreated($createdTime);
		$targetObj->setCurrentTime(710);

		$mediaEvent = new MediaEvent();
		$mediaEvent->setActor($testPerson);
		$mediaEvent->setAction(MediaActions::PAUSED);
		$mediaEvent->setObject($eventObj);
		$mediaEvent->setTarget($targetObj);
		$mediaEvent->setEdApp($application);
		$mediaEvent->setLisOrganization($organization);
		$mediaEvent->setStartedAtTime($sessionStartTime);

		$this->mediaEvent = $mediaEvent;
	}
	
	function testSessionEventSerializesToJSON() {
		$mediaEventJson = json_encode($this->mediaEvent, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
		$testFixtureFilePath = realpath(CALIPER_LIB_PATH . '/../../caliper-common-fixtures/src/test/resources/fixtures/caliperMediaEvent.json');

		$outputDir = getenv('PHPUNIT_OUTPUT_DIR');
		if ($outputDir != FALSE) {
		    file_put_contents(realpath($outputDir) . DIRECTORY_SEPARATOR . __CLASS__ . '.json', $mediaEventJson);
		}

		$this->assertJsonStringEqualsJsonFile($testFixtureFilePath, $mediaEventJson);
	}
}
