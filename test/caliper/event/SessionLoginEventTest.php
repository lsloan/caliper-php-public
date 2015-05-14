<?php
require_once realpath(dirname(__FILE__) . '/../../../lib/CaliperSensor.php');
require_once 'Caliper/entities/reading/EPubVolume.php';
require_once 'Caliper/entities/reading/EPubSubChapter.php';
require_once 'Caliper/entities/lis/LISPerson.php';
require_once 'Caliper/entities/lis/LISCourseSection.php';
require_once 'Caliper/entities/lis/Group.php';
require_once 'Caliper/entities/lis/Membership.php';
require_once 'Caliper/entities/SoftwareApplication.php';
require_once 'Caliper/entities/Session.php';
require_once 'Caliper/events/SessionEvent.php';
require_once 'Caliper/entities/lis/Role.php';
require_once 'Caliper/actions/Action.php';

class SessionLoginEventTest extends PHPUnit_Framework_TestCase {
	private $sessionEvent;
	
	function setUp() {
		$createdTime = new DateTime('2015-08-01T06:00:00.000Z');
		$modifiedTime = new DateTime('2015-09-02T11:30:00.000Z');

        $sessionStartTime = new DateTime('2015-09-15T10:15:00.000Z');

        $testPersonId = 'https://some-university.edu/user/554433';
        $testRole = Role::LEARNER;

        $courseOrganizationUrl = 'https://some-university.edu/politicalScience/2015/american-revolution-101';
        $courseMembership = new Membership('https://some-university.edu/membership/001');
        $courseMembership->setMember($testPersonId);
        $courseMembership->setOrganization($courseOrganizationUrl);
        $courseMembership->setRoles([$testRole]);
        $courseMembership->setDateCreated($createdTime);

        $sectionOrganizationUrl = 'https://some-university.edu/politicalScience/2015/american-revolution-101/section/001';
        $sectionMembership = new Membership('https://some-university.edu/membership/002');
        $sectionMembership->setMember($testPersonId);
        $sectionMembership->setOrganization($sectionOrganizationUrl);
        $sectionMembership->setRoles([$testRole]);
        $sectionMembership->setDateCreated($createdTime);

        $groupOrganizationUrl = 'https://some-university.edu/politicalScience/2015/american-revolution-101/section/001/group/001';
        $groupMembership = new Membership('https://some-university.edu/membership/003');
        $groupMembership->setMember($testPersonId);
        $groupMembership->setOrganization($groupOrganizationUrl);
        $groupMembership->setRoles([$testRole]);
        $groupMembership->setDateCreated($createdTime);

        $testPerson = new LISPerson($testPersonId);
        $testPerson->setRoles([$testRole]);
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
        $ePubVolume->setVersion('2nd ed.');


		$targetObj = new Frame('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3/1)');
		$targetObj->setName('Key Figures: George Washington');
		$targetObj->setDateCreated($createdTime);
		$targetObj->setDateModified($modifiedTime);
		$targetObj->setIsPartOf($ePubVolume);
		$targetObj->setIndex(1);
        $targetObj->setVersion('2nd ed.');

		$generatedObj = new Session('https://github.com/readium/session-123456789');
		$generatedObj->setName('session-123456789');
		$generatedObj->setDateCreated($createdTime);
		$generatedObj->setDateModified($modifiedTime);
		$generatedObj->setActor($testPerson);
		$generatedObj->setStartedAtTime($sessionStartTime);

        $courseOffering = new CourseOffering($courseOrganizationUrl);
        $courseOffering->setCourseNumber('POL101');
        $courseOffering->setName('Political Science 101: The American Revolution');
        $courseOffering->setAcademicSession('Fall-2015');
        $courseOffering->setDateCreated($createdTime);
        $courseOffering->setDateModified($modifiedTime);

        $courseSection = new LISCourseSection($sectionOrganizationUrl);
        $courseSection->setCourseNumber('POL101');
        $courseSection->setName('American Revolution 101');
        $courseSection->setAcademicSession('Fall-2015');
        $courseSection->setMembership([$sectionMembership]);
        $courseSection->setSubOrganizationOf($courseOffering);
        $courseSection->setDateCreated($createdTime);
        $courseSection->setDateModified($modifiedTime);

        $group = new Group($groupOrganizationUrl);
        $group->setName('Discussion Group 001');
        $group->setMembership([$groupMembership]);
        $group->setSubOrganizationOf($courseSection);
        $group->setDateCreated($createdTime);

		$sessionEvent = new SessionEvent();	
		$sessionEvent->setActor($testPerson);
		$sessionEvent->setAction(Action::LOGGED_IN);
		$sessionEvent->setObject($eventObj);
		$sessionEvent->setTarget($targetObj);
		$sessionEvent->setGenerated($generatedObj);
		$sessionEvent->setEdApp($eventObj);
		$sessionEvent->setGroup($group);
		$sessionEvent->setStartedAtTime($sessionStartTime);

		$this->sessionEvent = $sessionEvent;
	}

    /**
     * @group passes
     */
	function testSessionEventSerializesToJSON() {
		$sessionEventJson = json_encode($this->sessionEvent, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
		$testFixtureFilePath = realpath(CALIPER_LIB_PATH . '/../../caliper-common-fixtures/src/test/resources/fixtures/caliperSessionLoginEvent.json');

        $outputDir = getenv('PHPUNIT_OUTPUT_DIR');
        if ($outputDir != FALSE) {
            file_put_contents(realpath($outputDir) . DIRECTORY_SEPARATOR . __CLASS__ . '.json', $sessionEventJson);
        }

		$this->assertJsonStringEqualsJsonFile($testFixtureFilePath, $sessionEventJson);
	}
}
