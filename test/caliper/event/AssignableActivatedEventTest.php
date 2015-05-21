<?php
require_once realpath(dirname(__FILE__) . '/../../../lib/CaliperSensor.php');
require_once 'Caliper/actions/Action.php';
require_once 'Caliper/events/AssignableEvent.php';
require_once realpath(CALIPER_LIB_PATH . '/../test/util/TestUtilities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestAgentEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestAssessmentEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestAssignableEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestLisEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestTimes.php');

class AssignableActivatedEventTest extends PHPUnit_Framework_TestCase {
    private $testObject;

    function setUp() {
        $this->testObject = (new AssignableEvent())
            ->setActor(TestAgentEntities::makePerson())
            ->setAction(Action::ACTIVATED)
            ->setObject(TestAssessmentEntities::makeAssessment())
            ->setGenerated(TestAssignableEntities::makeAttempt()
                ->setAssignable(TestAssessmentEntities::makeAssessment()->getId()))
            ->setStartedAtTime(TestTimes::startedTime())
            ->setEdApp(TestAgentEntities::makeAssessmentApplication())
            ->setGroup(TestLisEntities::makeGroup())
            ->setMembership(TestLisEntities::makeMembership());
    }

    /**
     * @group passes
     */
    function testObjectSerializesToJson() {
        $testJson = json_encode($this->testObject, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        $testFixtureFilePath = realpath(CALIPER_LIB_PATH . '/../../caliper-common-fixtures/src/test/resources/fixtures/caliperAssignableEvent.json');

        TestUtilities::saveFormattedFixtureAndOutputJson($testFixtureFilePath, $testJson, __CLASS__);

        $this->assertJsonStringEqualsJsonFile($testFixtureFilePath, $testJson);
    }
}
