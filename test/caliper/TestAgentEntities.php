<?php
require_once 'Caliper/entities/agent/Person.php';
require_once 'Caliper/entities/agent/SoftwareApplication.php';

class TestAgentEntities {
    /** @return SoftwareApplication */
    public static function makeMediaApplication() {
        return (new SoftwareApplication('https://com.sat/super-media-tool'))
            ->setName('Super Media Tool')
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime());
    }

    /** @return Person */
    public static function makePerson() {
        return (new Person('https://some-university.edu/user/554433'))
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime());
    }

    /** @return SoftwareApplication */
    public static function makeReadingApplication() {
        return (new SoftwareApplication('https://github.com/readium/readium-js-viewer'))
            ->setName('Readium')
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime());
    }

    /** @return array */
    public static function makeWithAgents() {
        return [
            (new Person('https://some-university.edu/students/657585'))
                ->setDateCreated(TestTimes::createdTime())
                ->setDateModified(TestTimes::modifiedTime()),
            (new Person('https://some-university.edu/students/667788'))
                ->setDateCreated(TestTimes::createdTime())
                ->setDateModified(TestTimes::modifiedTime())
        ];
    }
}