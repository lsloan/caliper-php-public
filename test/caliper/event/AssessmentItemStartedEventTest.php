<?php
require_once realpath(dirname(__FILE__) . '/../CaliperTestCase.php');
require_once 'Caliper/events/AssessmentItemEvent.php';
require_once 'Caliper/actions/Action.php';

/**
 * @requires PHP 5.4
 */
class AssessmentItemStartedEventTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setFixtureFilename('/../../caliper-common-fixtures/src/test/resources/fixtures/caliperAssessmentItemStartedEvent.json');

        $this->setTestObject((new AssessmentItemEvent())
            ->setActor(TestAgentEntities::makePerson())
            ->setAction(new Action(Action::STARTED))
            ->setObject(TestAssessmentEntities::makeAssessmentItem())
            ->setGenerated(TestAssignableEntities::makeItemAttempt())
            ->setEventTime(TestTimes::startedTime())
            ->setEdApp(TestAgentEntities::makeAssessmentApplication())
            ->setGroup(TestLisEntities::makeGroup())
            ->setMembership(TestLisEntities::makeMembership()));
    }
}
