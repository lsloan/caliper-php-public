<?php
require_once realpath(dirname(__FILE__) . '/../../../lib/CaliperSensor.php');
require_once 'Caliper/events/ViewEvent.php';
require_once realpath(CALIPER_LIB_PATH . '/../test/util/TestUtilities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestAgentEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestLisEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestReadingEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestTimes.php');


class ViewedEventTest extends PHPUnit_Framework_TestCase {
    private $testObject;

    function  setUp() {
        $this->testObject = (new ViewEvent())
            ->setActor(TestAgentEntities::makePerson())
            ->setMembership(TestLisEntities::makeMembership())
            ->setObject(TestReadingEntities::makeEPubVolume())
            ->setTarget(TestReadingEntities::makeFrame())
            ->setEdApp(TestAgentEntities::makeReadingApplication())
            ->setGroup(TestLisEntities::makeGroup())
            ->setStartedAtTime(TestTimes::startedTime());
    }

    /**
     * @group passes
     */
    function testObjectSerializesToJson() {
        $testJson = json_encode($this->testObject, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        $testFixtureFilePath = realpath(CALIPER_LIB_PATH . '/../../caliper-common-fixtures/src/test/resources/fixtures/caliperViewEvent.json');

        TestUtilities::saveFormattedFixtureAndOutputJson($testFixtureFilePath, $testJson, __CLASS__);

        $this->assertJsonStringEqualsJsonFile($testFixtureFilePath, $testJson);

    }
}