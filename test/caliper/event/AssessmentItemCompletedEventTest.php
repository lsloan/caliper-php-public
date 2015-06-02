<?php
require_once realpath(dirname(__FILE__) . '/../CaliperTestCase.php');
require_once 'Caliper/events/AssessmentItemEvent.php';
require_once 'Caliper/actions/Action.php';

/**
 * @requires PHP 5.4
 */
class AssessmentItemCompletedEventTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setFixtureFilename('/../../caliper-common-fixtures/src/test/resources/fixtures/caliperAssessmentItemCompletedEvent.json');

        $this->setTestObject((new AssessmentItemEvent())
            ->setActor(TestAgentEntities::makePerson())
            ->setAction(new Action(Action::COMPLETED))
            ->setObject(TestAssessmentEntities::makeAssessmentItem())
            ->setGenerated(TestResponseEntities::makeFillinBlankResponse()
                ->setAttempt(TestAssignableEntities::makeItemAttempt())
                ->setStartedAtTime(TestTimes::startedTime())
                ->setValues('2 July 1776'))
            ->setStartedAtTime(TestTimes::startedTime())
            ->setEdApp(TestAgentEntities::makeAssessmentApplication())
            ->setGroup(TestLisEntities::makeGroup())
            ->setMembership(TestLisEntities::makeMembership()));
    }
}