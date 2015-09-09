<?php
require_once realpath(dirname(__FILE__) . '/../CaliperTestCase.php');
require_once 'Caliper/events/MediaEvent.php';
require_once 'Caliper/actions/Action.php';

/**
 * @requires PHP 5.4
 */
class MediaPausedEventTest extends CaliperTestCase {
	function setUp() {
        parent::setUp();

        $this->setFixtureFilename('/../../caliper-common-fixtures/src/test/resources/fixtures/caliperMediaEvent.json');

        $this->setTestObject((new MediaEvent())
            ->setActor(TestAgentEntities::makePerson())
            ->setMembership(TestLisEntities::makeMembership())
            ->setAction(new Action(Action::PAUSED))
            ->setObject(TestMediaEntities::makeVideoObject())
            ->setTarget(TestMediaEntities::makeMediaLocation())
            ->setEdApp(TestAgentEntities::makeMediaApplication())
            ->setGroup(TestLisEntities::makeGroup())
            ->setEventTime(TestTimes::startedTime()));
	}
}
