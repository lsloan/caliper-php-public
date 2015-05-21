<?php
require_once 'Caliper/entities/assignable/Attempt.php';

class TestAssignableEntities {
    public static function makeAttempt() {
        /** @return Attempt */
        return (new Attempt('https://some-university.edu/politicalScience/2015/american-revolution-101/assessment1/attempt1'))
            ->setDateCreated(TestTimes::createdTime())
            ->setAssignable(null)
            ->setActor(TestAgentEntities::makePerson()->getId())
            ->setCount(1)
            ->setStartedAtTime(TestTimes::startedTime());
    }
}