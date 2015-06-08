<?php
require_once 'Caliper/entities/LearningObjective.php';

class TestEntities {
    public static function makeLearningObjective() {
        return (new LearningObjective('https://example.edu/american-revolution-101/personalities/learn'))
            ->setDateCreated(TestTimes::createdTime());
    }
}