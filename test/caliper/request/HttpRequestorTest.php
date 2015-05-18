<?php
require_once realpath(dirname(__FILE__) . '/../../../lib/CaliperSensor.php');
require_once 'Caliper/entities/reading/EPubVolume.php';
require_once 'Caliper/entities/reading/EPubSubChapter.php';
require_once 'Caliper/entities/reading/Frame.php';
require_once 'Caliper/entities/agent/Person.php';
require_once 'Caliper/entities/lis/CourseSection.php';
require_once 'Caliper/entities/lis/Group.php';
require_once 'Caliper/entities/lis/Membership.php';
require_once 'Caliper/entities/agent/SoftwareApplication.php';
require_once 'Caliper/entities/DigitalResource.php';
require_once 'Caliper/entities/agent/Organization.php';
require_once 'Caliper/events/NavigationEvent.php';
require_once 'Caliper/entities/reading/WebPage.php';
require_once 'Caliper/entities/lis/Role.php';
require_once realpath(CALIPER_LIB_PATH . '/../test/util/TestUtilities.php');

class HttpRequestorTest extends PHPUnit_Framework_TestCase {
    private $testObject;

    function  setUp() {
        $createdTime = new DateTime('2015-08-01T06:00:00.000Z');
        $modifiedTime = new DateTime('2015-09-02T11:30:00.000Z');

        $navigationStartTime = new DateTime('2015-09-15T10:15:00.000Z');

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
        $testPerson->setDateCreated($createdTime)
            ->setDateModified($modifiedTime);

        $membership = new Membership('https://some-university.edu/politicalScience/2015/american-revolution-101/roster/554433');
        $membership
            ->setDateCreated($createdTime)
            ->setDescription('Roster entry')
            ->setMember($testPersonId)
            ->setName('American Revolution 101')
            ->setOrganization('https://some-university.edu/politicalScience/2015/american-revolution-101/section/001')
            ->setRoles($testRole);

        $edApp = new SoftwareApplication('https://github.com/readium/readium-js-viewer');
        $edApp->setName('Readium')
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime);

        $object = new EPubVolume('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3)');
        $object->setName('The Glorious Cause: The American Revolution, 1763-1789 (Oxford History of the United States)')
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime)
            ->setVersion('2nd ed.');

        $target = new Frame('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3/1)');
        $target->setName('Key Figures: George Washington')
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime)
            ->setIsPartOf($object)
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

        $fromResource = new WebPage('https://some-university.edu/politicalScience/2015/american-revolution-101/index.html');
        $fromResource->setName('American Revolution 101 Landing Page')
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime)
            ->setVersion('1.0');

        $navigationEvent = new NavigationEvent();
        $navigationEvent->setActor($testPerson)
            ->setMembership($membership)
            ->setObject($object)
            ->setNavigatedFrom($fromResource)
            ->setEdApp($edApp)
            ->setTarget($target)
            ->setGroup($group)
            ->setStartedAtTime($navigationStartTime);

        $envelope = new Envelope();
        $envelope
            ->setData($navigationEvent)
            ->setSensor('http://learning-app.some-university.edu/sensor')
            ->setSendTime(new DateTime('2015-09-15T11:05:01.000Z'));

        $this->testObject = $envelope;
    }

    /**
     * @group passes
     */
    function testEnvelopeSerializesToJSON() {
        $testJson = json_encode($this->testObject, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        $testFixtureFilePath = realpath(CALIPER_LIB_PATH .
            '/../../caliper-common-fixtures/src/test/resources/fixtures/eventStorePayload.json');

        TestUtilities::saveFormattedFixtureAndOutputJson($testFixtureFilePath, $testJson, __CLASS__);

        $this->assertJsonStringEqualsJsonFile($testFixtureFilePath, $testJson);
    }
}
