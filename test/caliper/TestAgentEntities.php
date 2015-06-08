<?php
require_once 'Caliper/entities/agent/Person.php';
require_once 'Caliper/entities/agent/SoftwareApplication.php';

class TestAgentEntities {
    /** @return SoftwareApplication */
    public static function makeAssessmentApplication() {
        return (new SoftwareApplication('https://example.com/super-assessment-tool'))
            ->setName('Super Assessment Tool')
            ->setDateCreated(TestTimes::createdTime());
    }

    public static function makeMediaApplication() {
        return (new SoftwareApplication('https://example.com/super-media-tool'))
            ->setName('Super Media Tool')
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime());
    }

    /** @return Person */
    public static function makePerson() {
        return (new Person('https://example.edu/user/554433'))
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime());
    }

    /** @return SoftwareApplication */
    public static function makeReadingApplication() {
        return (new SoftwareApplication('https://example.com/viewer'))
            ->setName('ePub')
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime());
    }

    /** @return array */
    public static function makeWithAgents() {
        return [
            (new Person('https://example.edu/user/657585'))
                ->setDateCreated(TestTimes::createdTime())
                ->setDateModified(TestTimes::modifiedTime()),
            (new Person('https://example.edu/user/667788'))
                ->setDateCreated(TestTimes::createdTime())
                ->setDateModified(TestTimes::modifiedTime())
        ];
    }
}