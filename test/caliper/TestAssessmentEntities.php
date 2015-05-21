<?php
require_once 'Caliper/entities/assessment/Assessment.php';

class TestAssessmentEntities {
    public static function makeAssessment() {
        /** @return Assessment */
        return (new Assessment('https://some-university.edu/politicalScience/2015/american-revolution-101/assessment1'))
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime())
            ->setDatePublished(TestTimes::publishedTime())
            ->setDateToActivate(TestTimes::activateTime())
            ->setDateToShow(TestTimes::showTime())
            ->setDateToStartOn(TestTimes::startOnTime())
            ->setDateToSubmit(TestTimes::submitTime())
            ->setMaxAttempts(2)
            ->setMaxScore(3)
            ->setMaxSubmits(2)
            ->setName('American Revolution - Key Figures Assessment')
            ->setVersion('1.0');
    }
}