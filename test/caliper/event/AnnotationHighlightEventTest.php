<?php
require_once realpath(dirname(__FILE__) . '/../CaliperTestCase.php');
require_once 'Caliper/events/AnnotationEvent.php';
require_once 'Caliper/actions/Action.php';

/**
 * @requires PHP 5.4
 */
class AnnotationHighlightEventTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setFixtureFilename('/../../caliper-common-fixtures/src/test/resources/fixtures/caliperHighlightAnnotationEvent.json');

        $this->setTestObject((new AnnotationEvent())
            ->setActor(TestAgentEntities::makePerson())
            ->setAction(new Action(Action::HIGHLIGHTED))
            ->setObject(TestReadingEntities::makeFrame1())
            ->setGenerated(TestAnnotationEntities::makeHighlightAnnotation())
            ->setEventTime(TestTimes::startedTime())
            ->setEdApp(TestAgentEntities::makeReadingApplication())
            ->setGroup(TestLisEntities::makeGroup())
            ->setMembership(TestLisEntities::makeMembership()));
    }
}