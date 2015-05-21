<?php
require_once 'Caliper/entities/assessment/Assessment.php';
require_once 'Caliper/entities/assessment/AssessmentItem.php';

class TestAssessmentEntities {
    /** @return Assessment */
    public static function makeAssessment() {
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

    /** @return AssessmentItem */
    public static function makeAssessmentItem() {
        return (new AssessmentItem('https://some-university.edu/politicalScience/2015/american-revolution-101/assessment1/item1'))
            ->setName('Assessment Item 1')
            ->setIsPartOf(TestAssessmentEntities::makeAssessment())
            ->setVersion('1.0')
            ->setMaxAttempts(2)
            ->setMaxSubmits(2)
            ->setMaxScore(1)
            ->setIsTimeDependent(false);
    }
}