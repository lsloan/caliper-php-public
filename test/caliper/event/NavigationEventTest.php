<?php
require_once realpath(dirname(__FILE__) . '/../../../lib/CaliperSensor.php');
require_once 'Caliper/entities/reading/EPubVolume.php';
require_once 'Caliper/entities/reading/EPubSubChapter.php';
require_once 'Caliper/entities/lis/LISPerson.php';
require_once 'Caliper/entities/lis/LISCourseSection.php';
require_once 'Caliper/entities/SoftwareApplication.php';
require_once 'Caliper/entities/CaliperDigitalResource.php';
require_once 'Caliper/entities/lis/LISOrganization.php';
require_once 'Caliper/events/NavigationEvent.php';
require_once 'Caliper/entities/schemadotorg/WebPage.php';

class NavigationEventTest extends PHPUnit_Framework_TestCase {
	private $navigationEvent;
	
    function  setUp() {
        $createdTime = '2015-01-01T06:00:00Z';
        $modifiedTime = '2015-02-02T11:30:00Z';

        $testPerson = new LISPerson('https://some-university.edu/user/554433');
        $testPerson->setDateCreated($createdTime);
        $testPerson->setDateModified($modifiedTime);

		$organization = new LISCourseSection('https://some-university.edu/politicalScience/2014/american-revolution-101');
		$organization->setCourseNumber('AmRev-101');
        $organization->setLabel('Am Rev 101');
		$organization->setName('American Revolution 101');
		$organization->setSemester('Spring-2014');
        $organization->setDateCreated($createdTime);
        $organization->setDateModified($modifiedTime);
		
		$fromResource = new WebPage('AmRev-101-landingPage');
		$fromResource->setName('American Revolution 101 Landing Page');
		$fromResource->setIsPartOf($organization);
        $fromResource->setDateCreated($createdTime);
        $fromResource->setDateModified($modifiedTime);

		$edApp = new SoftwareApplication('https://github.com/readium/readium-js-viewer');
        $edApp->setName('Readium');
        $edApp->setDateCreated($createdTime);
        $edApp->setDateModified($modifiedTime);

		$object = new EPubVolume('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3)');
		$object->setName('The Glorious Cause: The American Revolution, 1763-1789 (Oxford History of the United States)');
        $object->setDateCreated($createdTime);
        $object->setDateModified($modifiedTime);

        // TODO Implement Frame.  JS test uses Frame.  PHP library doesn't have it.
        $target = new EPubSubChapter('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3/1)');
        // TODO remove this setType.  caliper-php doesn't implement Frame, but test fixture requires this value
        $target->setType('http://purl.imsglobal.org/caliper/v1/Frame');
        $target->setName('Key Figures: George Washington');
        $target->setDateCreated($createdTime);
        $target->setDateModified($modifiedTime);
        $target->setIsPartOf($object);
        $target->setIndex(1);

        $navigationEvent = new NavigationEvent();
		$navigationEvent->setActor($testPerson);
		$navigationEvent->setObject($object);
		$navigationEvent->setFromResource($fromResource);
		$navigationEvent->setEdApp($edApp);
        $navigationEvent->setTarget($target);
		$navigationEvent->setLisOrganization($organization);
        $navigationEvent->setStartedAtTime($modifiedTime);

        $this->navigationEvent = $navigationEvent;
    }
	
    function testNavigationEventSerializesToJSON(){
        $navigationEventJson = json_encode($this->navigationEvent,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
        $testFixtureFilePath = realpath(CALIPER_LIB_PATH . '/../../caliper-common-fixtures/src/test/resources/fixtures/caliperNavigationEvent.json');

        if (array_key_exists('PHPUNIT_OUTPUT_DIR', $_SERVER)) {
            file_put_contents(realpath($_SERVER['PHPUNIT_OUTPUT_DIR']) . DIRECTORY_SEPARATOR . __CLASS__ . '.json', $navigationEventJson);
        }

        $this->assertJsonStringEqualsJsonFile($testFixtureFilePath, $navigationEventJson);
    }
}