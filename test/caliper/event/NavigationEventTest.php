<?php
require_once realpath(dirname(__FILE__) . '/../../../lib/CaliperSensor.php');
require_once 'Caliper/events/NavigationEvent.php';
require_once realpath(CALIPER_LIB_PATH . '/../test/util/TestUtilities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestAgentEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestLisEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestReadingEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestTimes.php');


class NavigationEventTest extends PHPUnit_Framework_TestCase {
	private $testObject;
	
    function  setUp() {
        $this->testObject = (new NavigationEvent())
            ->setActor(TestAgentEntities::makePerson())
            ->setMembership(TestLisEntities::makeMembership())
            ->setObject(TestReadingEntities::makeEPubVolume())
            ->setNavigatedFrom(TestReadingEntities::makeWebPage())
            ->setEdApp(TestAgentEntities::makeSoftwareApplication())
            ->setTarget(TestReadingEntities::makeFrame())
            ->setGroup(TestLisEntities::makeGroup())
            ->setStartedAtTime(TestTimes::navigationStartTime());
    }

    /**
     * @group passes
     */
    function testEventSerializesToJSON(){
        $navigationEventJson = json_encode($this->testObject,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        $testFixtureFilePath = realpath(CALIPER_LIB_PATH . '/../../caliper-common-fixtures/src/test/resources/fixtures/caliperNavigationEvent.json');

        TestUtilities::saveFormattedFixtureAndOutputJson($testFixtureFilePath, $navigationEventJson, __CLASS__);

        $this->assertJsonStringEqualsJsonFile($testFixtureFilePath, $navigationEventJson);
    }
}
