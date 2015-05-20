<?php
require_once 'Caliper/entities/LearningObjective.php';

class TestEntities {
    public static function makeLearningObjective() {
        return (new LearningObjective('http://americanrevolution.com/personalities/learn'))
            ->setDateCreated(TestTimes::createdTime());
    }
}