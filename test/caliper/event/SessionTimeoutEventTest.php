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
require_once realpath(CALIPER_LIB_PATH . '/../test/util/TestUtilities.php');

class SessionTimeoutEventTest extends PHPUnit_Framework_TestCase {
	private $sessionEvent;
	
	function setUp() {
        $createdTime = new DateTime('2015-08-01T06:00:00.000Z');
        $modifiedTime = new DateTime('2015-09-02T11:30:00.000Z');

        $sessionStartTime = new DateTime('2015-09-15T10:15:00.000Z');
        $sessionEndTime = new DateTime('2015-09-15T11:05:00.000Z');
        $sessionDurationSeconds = $sessionEndTime->getTimestamp() - $sessionStartTime->getTimestamp();

        $testPersonId = 'https://some-university.edu/user/554433';
        $testRole = Role::LEARNER;

        $courseOrganizationUrl = 'https://some-university.edu/politicalScience/2015/american-revolution-101';
        $courseMembership = new Membership('https://some-university.edu/membership/001');
        $courseMembership->setMember($testPersonId)
            ->setOrganization($courseOrganizationUrl)
            ->setRoles([$testRole])
            ->setDateCreated($createdTime);

        $sectionOrganizationUrl = 'https://some-university.edu/politicalScience/2015/american-revolution-101/section/001';
        $sectionMembership = new Membership('https://some-university.edu/membership/002');
        $sectionMembership->setMember($testPersonId)
            ->setOrganization($sectionOrganizationUrl)
            ->setRoles([$testRole])
            ->setDateCreated($createdTime);

        $groupOrganizationUrl = 'https://some-university.edu/politicalScience/2015/american-revolution-101/section/001/group/001';
        $groupMembership = new Membership('https://some-university.edu/membership/003');
        $groupMembership->setMember($testPersonId)
            ->setOrganization($groupOrganizationUrl)
            ->setRoles([$testRole])
            ->setDateCreated($createdTime);

        $testPerson = new LISPerson($testPersonId);
        $testPerson->setRoles([Role::LEARNER])
		    ->setDateCreated($createdTime)
		    ->setDateModified($modifiedTime);

		$eventObj = new SoftwareApplication('https://github.com/readium/readium-js-viewer');
		$eventObj->setName('Readium')
		    ->setDateCreated($createdTime)
		    ->setDateModified($modifiedTime);

		$ePubVolume = new EPubVolume('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3)');	
		$ePubVolume->setName('The Glorious Cause: The American Revolution, 1763-1789 (Oxford History of the United States)')
		    ->setDateCreated($createdTime)
		    ->setDateModified($modifiedTime);

		$targetObj = new Session('https://github.com/readium/session-123456789');
		$targetObj->setName('session-123456789')
		    ->setDateCreated($createdTime)
		    ->setDateModified($modifiedTime)
		    ->setActor($testPerson)
		    ->setStartedAtTime($sessionStartTime)
		    ->setEndedAtTime($sessionEndTime)
            ->setDuration($sessionDurationSeconds);

        $courseOffering = new CourseOffering($courseOrganizationUrl);
        $courseOffering->setCourseNumber('POL101')
            ->setName('Political Science 101: The American Revolution')
            ->setAcademicSession('Fall-2015')
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime);

        $courseSection = new LISCourseSection($sectionOrganizationUrl);
        $courseSection->setCourseNumber('POL101')
            ->setName('American Revolution 101')
            ->setAcademicSession('Fall-2015')
            ->setMembership([$sectionMembership])
            ->setSubOrganizationOf($courseOffering)
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime);

        $group = new Group($groupOrganizationUrl);
        $group->setName('Discussion Group 001')
            ->setMembership([$groupMembership])
            ->setSubOrganizationOf($courseSection)
            ->setDateCreated($createdTime);

        $sessionEvent = new SessionEvent();
		$sessionEvent->setActor($eventObj)
		    ->setAction(Action::TIMED_OUT)
		    ->setObject($eventObj)
		    ->setTarget($targetObj)
		    ->setEdApp($eventObj)
		    ->setGroup($group)
		    ->setStartedAtTime($sessionStartTime)
		    ->setEndedAtTime($sessionEndTime)
            ->setDuration($sessionDurationSeconds);

		$this->sessionEvent = $sessionEvent;
	}

    /**
     * @group passes
     */
	function testSessionEventSerializesToJSON() {
		$sessionEventJson = json_encode($this->sessionEvent, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
		$testFixtureFilePath = realpath(CALIPER_LIB_PATH . '/../../caliper-common-fixtures/src/test/resources/fixtures/caliperSessionTimeoutEvent.json');

        TestUtilities::saveFormattedFixtureAndOutputJson($testFixtureFilePath, $sessionEventJson, __CLASS__);

		$this->assertJsonStringEqualsJsonFile($testFixtureFilePath, $sessionEventJson);
	}
}
