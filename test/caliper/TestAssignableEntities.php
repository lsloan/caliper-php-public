<?php
require_once 'Caliper/entities/assignable/Attempt.php';
require_once 'Caliper/entities/outcome/Result.php';

class TestAssignableEntities {
    public static function makeAttempt() {
        /** @return Attempt */
        return (new Attempt('https://some-university.edu/politicalScience/2015/american-revolution-101/assessment1/attempt1'))
            ->setDateCreated(TestTimes::createdTime())
            ->setActor(TestAgentEntities::makePerson()->getId())
            ->setCount(1)
            ->setStartedAtTime(TestTimes::startedTime());
    }

    public static function makeResult() {
        /** @return Result */
        return (new Result('https://some-university.edu/politicalScience/2015/american-revolution-101/assessment1/attempt1/result'))
            ->setDateCreated(TestTimes::createdTime())
            ->setAssignable(TestAssessmentEntities::makeAssessment()->getId())
            ->setActor(TestAgentEntities::makePerson()->getId())
            ->setNormalScore(3)
            ->setPenaltyScore(0)
            ->setExtraCreditScore(0)
            ->setTotalScore(3)
            ->setCurvedTotalScore(3)
            ->setCurveFactor(0)
            ->setComment('Well done.')
            ->setScoredBy(TestAgentEntities::makeAssessmentApplication());
    }
}