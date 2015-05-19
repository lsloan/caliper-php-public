<?php
require_once realpath(dirname(__FILE__) . '/../../../lib/CaliperSensor.php');
require_once 'Caliper/entities/reading/EPubSubChapter.php';
require_once 'Caliper/entities/lis/CourseSection.php';
require_once 'Caliper/entities/lis/Group.php';
require_once 'Caliper/entities/lis/Membership.php';
require_once 'Caliper/entities/DigitalResource.php';
require_once 'Caliper/events/NavigationEvent.php';
require_once realpath(CALIPER_LIB_PATH . '/../test/util/TestUtilities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestRequests.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestTimes.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestAgentEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestLisEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestReadingEntities.php');

class HttpRequestorTest extends PHPUnit_Framework_TestCase {
    private $testObject;

    function setUp() {
        $courseMembership = new Membership('https://some-university.edu/membership/001');
        $courseMembership->setMember(TestAgentEntities::makePerson()->getId())
            ->setOrganization(TestLisEntities::makeCourseOffering()->getId())
            ->setRoles(TestLisEntities::makeMembership()->getRoles())
            ->setDateCreated(TestTimes::createdTime());

        $sectionOrganizationUrl = 'https://some-university.edu/politicalScience/2015/american-revolution-101/section/001';
        $sectionMembership = new Membership('https://some-university.edu/membership/002');
        $sectionMembership->setMember(TestAgentEntities::makePerson()->getId())
            ->setOrganization($sectionOrganizationUrl)
            ->setRoles(TestLisEntities::makeMembership()->getRoles())
            ->setDateCreated(TestTimes::createdTime());

        $groupOrganizationUrl = 'https://some-university.edu/politicalScience/2015/american-revolution-101/section/001/group/001';
        $groupMembership = new Membership('https://some-university.edu/membership/003');
        $groupMembership->setMember(TestAgentEntities::makePerson()->getId())
            ->setOrganization($groupOrganizationUrl)
            ->setRoles(TestLisEntities::makeMembership()->getRoles())
            ->setDateCreated(TestTimes::createdTime());




        $courseOffering = TestLisEntities::makeCourseOffering();

        $courseSection = new CourseSection($sectionOrganizationUrl);
        $courseSection->setCourseNumber('POL101')
            ->setName('American Revolution 101')
            ->setAcademicSession('Fall-2015')
            ->setMembership([$sectionMembership])
            ->setSubOrganizationOf($courseOffering)
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime());

        $group = new Group($groupOrganizationUrl);
        $group->setName('Discussion Group 001')
            ->setMembership([$groupMembership])
            ->setSubOrganizationOf($courseSection)
            ->setDateCreated(TestTimes::createdTime());

        $navigationEvent = (new NavigationEvent())->setActor(TestAgentEntities::makePerson())
            ->setMembership(TestLisEntities::makeMembership())
            ->setObject(TestReadingEntities::makeEPubVolume())
            ->setNavigatedFrom(TestReadingEntities::makeWebPage())
            ->setEdApp(TestAgentEntities::makeSoftwareApplication())
            ->setTarget(TestReadingEntities::makeFrame())
            ->setGroup($group)
            ->setStartedAtTime(TestTimes::navigationStartTime());

        $this->testObject = TestRequests::makeEnvelope()->setData($navigationEvent);
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
