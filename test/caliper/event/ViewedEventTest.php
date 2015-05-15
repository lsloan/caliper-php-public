<?php
require_once realpath(dirname(__FILE__) . '/../../../lib/CaliperSensor.php');
require_once 'Caliper/entities/DigitalResource.php';
require_once 'Caliper/entities/reading/EPubVolume.php';
require_once 'Caliper/entities/reading/Frame.php';
require_once 'Caliper/entities/lis/CourseSection.php';
require_once 'Caliper/entities/lis/Group.php';
require_once 'Caliper/entities/lis/Membership.php';
require_once 'Caliper/entities/agent/Organization.php';
require_once 'Caliper/entities/agent/Person.php';
require_once 'Caliper/entities/agent/SoftwareApplication.php';
require_once 'Caliper/events/ViewEvent.php';
require_once 'Caliper/entities/reading/WebPage.php';
require_once 'Caliper/entities/lis/Role.php';
require_once realpath(CALIPER_LIB_PATH . '/../test/util/TestUtilities.php');

class ViewedEventTest extends PHPUnit_Framework_TestCase {

    private $eventObject;

    function  setUp() {
        $createdTime = new DateTime('2015-08-01T06:00:00.000Z');
        $modifiedTime = new DateTime('2015-09-02T11:30:00.000Z');
        $startedTime = new DateTime('2015-09-15T10:15:00.000Z');

        $courseSection = new CourseSection('https://some-university.edu/politicalScience/2014/american-revolution-101');
        $courseSection->setCourseNumber('AmRev-101')
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime);

        $application = new SoftwareApplication('https://github.com/readium/readium-js-viewer');
        $application->setName('Readium')
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime);

        $personId = 'https://some-university.edu/user/554433';
        $personRole = Role::LEARNER;
        $person = new Person($personId);
        $person->setRoles($personRole)
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime);

        $courseOrganizationUrl = 'https://some-university.edu/politicalScience/2015/american-revolution-101';
        $courseMembership = new Membership('https://some-university.edu/membership/001');
        $courseMembership->setMember($personId)
            ->setOrganization($courseOrganizationUrl)
            ->setRoles($personRole)
            ->setDateCreated($createdTime);

        $sectionOrganizationUrl = 'https://some-university.edu/politicalScience/2015/american-revolution-101/section/001';
        $sectionMembership = new Membership('https://some-university.edu/membership/002');
        $sectionMembership->setMember($personId)
            ->setOrganization($sectionOrganizationUrl)
            ->setRoles($personRole)
            ->setDateCreated($createdTime);

        $groupOrganizationUrl = 'https://some-university.edu/politicalScience/2015/american-revolution-101/section/001/group/001';
        $groupMembership = new Membership('https://some-university.edu/membership/003');
        $groupMembership->setMember($personId)
            ->setOrganization($groupOrganizationUrl)
            ->setRoles($personRole)
            ->setDateCreated($createdTime);

        $reading = new EPubVolume('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3)');
        $reading->setName('The Glorious Cause: The American Revolution, 1763-1789 (Oxford History of the United States)')
            ->setVersion('2nd ed.')
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime);

        $frame = new Frame('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3/1)');
        $frame->setName('Key Figures: George Washington')
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime)
            ->setIsPartOf($reading)
            ->setVersion('2nd ed.')
            ->setIndex(1);

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

        $viewedEvent = new ViewEvent();
        $viewedEvent->setActor($person)
            ->setObject($reading)
            ->setTarget($frame)
            ->setEdApp($application)
            ->setGroup($group)
            ->setStartedAtTime($startedTime);

        $this->eventObject = $viewedEvent;
    }

    /**
     * @group passes
     */
    function testEventSerializesToJSON() {
        $eventJson = json_encode($this->eventObject, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        $testFixtureFilePath = realpath(CALIPER_LIB_PATH . '/../../caliper-common-fixtures/src/test/resources/fixtures/caliperViewEvent.json');

        TestUtilities::saveFormattedFixtureAndOutputJson($testFixtureFilePath, $eventJson, __CLASS__);

        $this->assertJsonStringEqualsJsonFile($testFixtureFilePath, $eventJson);

    }
}