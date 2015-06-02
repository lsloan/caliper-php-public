<?php
require_once 'Caliper/entities/response/FillinBlankResponse.php';

class TestResponseEntities {
    /** @return FillinBlankResponse */
    public static function makeFillinBlankResponse() {
        return (new FillinBlankResponse('https://some-university.edu/politicalScience/2015/american-revolution-101/assessment1/item1/response1'))
            ->setDateCreated(TestTimes::createdTime())
            ->setAssignable(TestAssessmentEntities::makeAssessment())
            ->setActor(TestAgentEntities::makePerson())
            ->setAttempt(TestAssignableEntities::makeItemAttempt())
            ->setStartedAtTime(TestTimes::startedTime())
            ->setValues('2 July 1776');
    }
}