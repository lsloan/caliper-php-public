<?php
require_once realpath(dirname(__FILE__) . '/../../../lib/CaliperSensor.php');
require_once 'Caliper/entities/reading/EPubVolume.php';
require_once 'Caliper/entities/reading/EPubSubChapter.php';
require_once 'Caliper/entities/lis/LISPerson.php';
require_once 'Caliper/entities/lis/LISCourseSection.php';
require_once 'Caliper/entities/lis/Group.php';
require_once 'Caliper/entities/lis/Membership.php';
require_once 'Caliper/entities/SoftwareApplication.php';
require_once 'Caliper/entities/CaliperDigitalResource.php';
require_once 'Caliper/entities/lis/LISOrganization.php';
require_once 'Caliper/events/NavigationEvent.php';
require_once 'Caliper/entities/schemadotorg/WebPage.php';
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

		$edApp = new SoftwareApplication('https://github.com/readium/readium-js-viewer');
        $edApp->setName('Readium');
        $edApp->setDateCreated($createdTime);
        $edApp->setDateModified($modifiedTime);

		$object = new EPubVolume('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3)');
		$object->setName('The Glorious Cause: The American Revolution, 1763-1789 (Oxford History of the United States)');
        $object->setDateCreated($createdTime);
        $object->setDateModified($modifiedTime);
        $object->setVersion('2nd ed.');

        // TODO Implement Frame.  JS test uses Frame.  PHP library doesn't have it.
        $target = new EPubSubChapter('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3/1)');
        // TODO remove this setType.  caliper-php doesn't implement Frame, but test fixture requires this value
        $target->setType('http://purl.imsglobal.org/caliper/v1/Frame');
        $target->setName('Key Figures: George Washington');
        $target->setDateCreated($createdTime);
        $target->setDateModified($modifiedTime);
        $target->setIsPartOf($object);
        $target->setVersion('2nd ed.');
        $target->setIndex(1);

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

        $fromResource = new WebPage('https://some-university.edu/politicalScience/2015/american-revolution-101/index.html');
        $fromResource->setName('American Revolution 101 Landing Page');
        $fromResource->setDateCreated($createdTime);
        $fromResource->setDateModified($modifiedTime);
        $fromResource->setVersion('1.0');

        $navigationEvent = new NavigationEvent();
		$navigationEvent->setActor($testPerson);
		$navigationEvent->setObject($object);
		$navigationEvent->setNavigatedFrom($fromResource);
		$navigationEvent->setEdApp($edApp);
        $navigationEvent->setTarget($target);
		$navigationEvent->setGroup($group);
        $navigationEvent->setStartedAtTime($navigationStartTime);

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
    function testEnvelopeSerializesToJSON(){
        $testJson = json_encode($this->testObject, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        $testFixtureFilePath = realpath(CALIPER_LIB_PATH .
            '/../../caliper-common-fixtures/src/test/resources/fixtures/eventStorePayload.json');

        TestUtilities::saveFormattedFixtureAndOutputJson($testFixtureFilePath, $testJson, __CLASS__);

        $this->assertJsonStringEqualsJsonFile($testFixtureFilePath, $testJson);
    }
}
