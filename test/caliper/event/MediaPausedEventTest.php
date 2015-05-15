<?php
require_once realpath(dirname(__FILE__) . '/../../../lib/CaliperSensor.php');
require_once 'Caliper/actions/Action.php';
require_once 'Caliper/entities/lis/Role.php';
require_once 'Caliper/events/MediaEvent.php';
require_once 'Caliper/entities/agent/Person.php';
require_once 'Caliper/entities/lis/CourseSection.php';
require_once 'Caliper/entities/lis/Group.php';
require_once 'Caliper/entities/lis/Membership.php';
require_once 'Caliper/entities/agent/SoftwareApplication.php';
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

        $testPerson = new Person($testPersonId);
        $testPerson->setRoles([$testRole])
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime);

        $application = new SoftwareApplication('https://com.sat/super-media-tool');
		$application->setName('Super Media Tool')
		    ->setDateCreated($createdTime)
		    ->setDateModified($modifiedTime);

        $courseOffering = new CourseOffering($courseOrganizationUrl);
        $courseOffering->setCourseNumber('POL101')
            ->setName('Political Science 101: The American Revolution')
            ->setAcademicSession('Fall-2015')
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime);

        $courseSection = new CourseSection($sectionOrganizationUrl);
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

		$alignedLearningObjective = new LearningObjective('http://americanrevolution.com/personalities/learn');
		$alignedLearningObjective->setDateCreated($createdTime);

		$eventObj = new VideoObject('https://com.sat/super-media-tool/video/video1');
		$eventObj->setName('American Revolution - Key Figures Video')
		    ->setAlignedLearningObjectives([$alignedLearningObjective])
		    ->setDateCreated($createdTime)
		    ->setDateModified($modifiedTime)
		    ->setDuration(1420)
            ->setVersion('1.0');

		$targetObj = new MediaLocation('https://com.sat/super-media-tool/video/video1');
		$targetObj->setDateCreated($createdTime)
		    ->setCurrentTime(710)
            ->setVersion('1.0');

		$mediaEvent = new MediaEvent();
		$mediaEvent->setActor($testPerson)
		    ->setAction(Action::PAUSED)
		    ->setObject($eventObj)
		    ->setTarget($targetObj)
		    ->setEdApp($application)
		    ->setGroup($group)
		    ->setStartedAtTime($startedAtTime);

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
