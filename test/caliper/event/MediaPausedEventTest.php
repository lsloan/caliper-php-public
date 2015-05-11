<?php
require_once realpath(dirname(__FILE__) . '/../../../lib/CaliperSensor.php');
require_once 'Caliper/actions/Action.php';
require_once 'Caliper/entities/lis/Role.php';
require_once 'Caliper/events/MediaEvent.php';
require_once 'Caliper/entities/lis/LISPerson.php';
require_once 'Caliper/entities/lis/LISCourseSection.php';
require_once 'Caliper/entities/lis/Group.php';
require_once 'Caliper/entities/lis/Membership.php';
require_once 'Caliper/entities/SoftwareApplication.php';
require_once 'Caliper/entities/media/MediaLocation.php';
require_once 'Caliper/entities/media/VideoObject.php';
require_once 'Caliper/entities/LearningObjective.php';
require_once realpath(CALIPER_LIB_PATH . '/../test/util/TestUtilities.php');

class MediaPausedEventTest extends PHPUnit_Framework_TestCase {
	private $mediaEvent;
	
	function setUp() {
        $createdTime = new DateTime('2015-08-01T06:00:00.000Z');
        $modifiedTime = new DateTime('2015-09-02T11:30:00.000Z');

        $startedAtTime = new DateTime('2015-09-15T10:15:00.000Z');

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

        $application = new SoftwareApplication('https://com.sat/super-media-tool');
		$application->setName('Super Media Tool');
		$application->setDateCreated($createdTime);
		$application->setDateModified($modifiedTime);

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

        /*
        $organization = new LISCourseSection('https://some-university.edu/politicalScience/2014/american-revolution-101');
		$organization->setAcademicSession('Spring-2014');
		$organization->setCourseNumber('AmRev-101');
		$organization->setName('American Revolution 101');
		$organization->setDateCreated($createdTime);
		$organization->setDateModified($modifiedTime);
        */

		$alignedLearningObjective = new LearningObjective('http://americanrevolution.com/personalities/learn');
		$alignedLearningObjective->setDateCreated($createdTime);

		$eventObj = new VideoObject('https://com.sat/super-media-tool/video/video1');
		$eventObj->setName('American Revolution - Key Figures Video');
		$eventObj->setAlignedLearningObjectives([$alignedLearningObjective]);
		$eventObj->setDateCreated($createdTime);
		$eventObj->setDateModified($modifiedTime);
		$eventObj->setDuration(1420);
        $eventObj->setVersion('1.0');

		$targetObj = new MediaLocation('https://com.sat/super-media-tool/video/video1');
		$targetObj->setDateCreated($createdTime);
		$targetObj->setCurrentTime(710);
        $targetObj->setVersion('1.0');

		$mediaEvent = new MediaEvent();
		$mediaEvent->setActor($testPerson);
		$mediaEvent->setAction(Action::PAUSED);
		$mediaEvent->setObject($eventObj);
		$mediaEvent->setTarget($targetObj);
		$mediaEvent->setEdApp($application);
		$mediaEvent->setGroup($group);
		$mediaEvent->setStartedAtTime($startedAtTime);

		$this->mediaEvent = $mediaEvent;
	}

    /**
     * @group passes
     */
	function testSessionEventSerializesToJSON() {
        $mediaEventJson = json_encode($this->mediaEvent, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
		$testFixtureFilePath = realpath(CALIPER_LIB_PATH . '/../../caliper-common-fixtures/src/test/resources/fixtures/caliperMediaEvent.json');

        TestUtilities::saveFormattedFixtureAndOutputJson($testFixtureFilePath, $mediaEventJson, __CLASS__);

		$this->assertJsonStringEqualsJsonFile($testFixtureFilePath, $mediaEventJson);
	}
}
