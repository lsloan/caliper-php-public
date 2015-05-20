<?php
require_once realpath(dirname(__FILE__) . '/../../../lib/CaliperSensor.php');
require_once 'Caliper/actions/Action.php';
require_once 'Caliper/events/MediaEvent.php';
require_once realpath(CALIPER_LIB_PATH . '/../test/util/TestUtilities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestAgentEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestLisEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestMediaEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestTimes.php');

class MediaPausedEventTest extends PHPUnit_Framework_TestCase {
	private $testObject;

	function setUp() {
		$this->testObject = (new MediaEvent())
            ->setActor(TestAgentEntities::makePerson())
            ->setMembership(TestLisEntities::makeMembership())
            ->setAction(Action::PAUSED)
            ->setObject(TestMediaEntities::makeVideoObject())
            ->setTarget(TestMediaEntities::makeMediaLocation())
            ->setEdApp(TestAgentEntities::makeMediaApplication())
            ->setGroup(TestLisEntities::makeGroup())
            ->setStartedAtTime(TestTimes::startedTime());
	}

    /**
     * @group passes
     */
	function testObjectSerializesToJson() {
        $testJson = json_encode($this->testObject, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
		$testFixtureFilePath = realpath(CALIPER_LIB_PATH . '/../../caliper-common-fixtures/src/test/resources/fixtures/caliperMediaEvent.json');

        TestUtilities::saveFormattedFixtureAndOutputJson($testFixtureFilePath, $testJson, __CLASS__);

		$this->assertJsonStringEqualsJsonFile($testFixtureFilePath, $testJson);
	}
}
