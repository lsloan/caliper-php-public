<?php
require_once realpath(dirname(__FILE__) . '/../CaliperTestCase.php');
require_once 'Caliper/events/AnnotationEvent.php';
require_once 'Caliper/actions/Action.php';

/**
 * @requires PHP 5.4
 */
class AnnotationBookmarkedEventTest extends CaliperTestCase {
	function setUp() {
        parent::setUp();

        $this->setFixtureFilename('/../../caliper-common-fixtures/src/test/resources/fixtures/caliperBookmarkAnnotationEvent.json');

        $this->setTestObject((new AnnotationEvent())
            ->setActor(TestAgentEntities::makePerson())
            ->setAction(new Action(Action::BOOKMARKED))
            ->setObject(TestReadingEntities::makeFrame2())
            ->setGenerated(TestAnnotationEntities::makeBookmarkAnnotation())
            ->setEventTime(TestTimes::startedTime())
            ->setEdApp(TestAgentEntities::makeReadingApplication())
            ->setGroup(TestLisEntities::makeGroup())
            ->setMembership(TestLisEntities::makeMembership()));
	}
}