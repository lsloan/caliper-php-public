<?php
require_once realpath(dirname(__FILE__) . '/../CaliperTestCase.php');
require_once 'Caliper/events/AnnotationEvent.php';
require_once 'Caliper/actions/Action.php';

/**
 * @requires PHP 5.4
 */
class AnnotationSharedEventTest extends CaliperTestCase {
	function setUp() {
        parent::setUp();

        $this->setFixtureFilename('/../../caliper-common-fixtures/src/test/resources/fixtures/caliperSharedAnnotationEvent.json');

        $this->setTestObject((new AnnotationEvent())
            ->setActor(TestAgentEntities::makePerson())
            ->setAction(new Action(Action::SHARED))
            ->setObject(TestReadingEntities::makeFrame3())
            ->setGenerated(TestAnnotationEntities::makeSharedAnnotation())
            ->setEventTime(TestTimes::startedTime())
            ->setEdApp(TestAgentEntities::makeReadingApplication())
            ->setGroup(TestLisEntities::makeGroup())
            ->setMembership(TestLisEntities::makeMembership()));
	}
}