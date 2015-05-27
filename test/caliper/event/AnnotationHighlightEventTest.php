<?php
require_once realpath(dirname(__FILE__) . '/../../../lib/CaliperSensor.php');
require_once 'Caliper/actions/Action.php';
require_once 'Caliper/events/AnnotationEvent.php';
require_once realpath(CALIPER_LIB_PATH . '/../test/util/TestUtilities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestAgentEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestAnnotationEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestLisEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestReadingEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestTimes.php');

/**
 * @requires PHP 5.4
 */
class AnnotationHighlightEventTest extends PHPUnit_Framework_TestCase {
	private $testObject;

	function setUp() {
        $this->testObject = (new AnnotationEvent())
            ->setActor(TestAgentEntities::makePerson())
            ->setAction(Action::HIGHLIGHTED)
            ->setObject(TestReadingEntities::makeFrame1())
            ->setGenerated(TestAnnotationEntities::makeHighlightAnnotation())
            ->setStartedAtTime(TestTimes::startedTime())
            ->setEdApp(TestAgentEntities::makeReadingApplication())
            ->setGroup(TestLisEntities::makeGroup())
            ->setMembership(TestLisEntities::makeMembership())
        ;
	}

    /**
     * @group passes
     */
	function testObjectSerializesToJson() {
        $testJson = json_encode($this->testObject, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
		$testFixtureFilePath = realpath(CALIPER_LIB_PATH . '/../../caliper-common-fixtures/src/test/resources/fixtures/caliperHighlightAnnotationEvent.json');

        TestUtilities::saveFormattedFixtureAndOutputJson($testFixtureFilePath, $testJson, __CLASS__);

		$this->assertJsonStringEqualsJsonFile($testFixtureFilePath, $testJson);
	}
}
