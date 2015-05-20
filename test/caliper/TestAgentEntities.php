<?php
require_once 'Caliper/entities/agent/Person.php';
require_once 'Caliper/entities/agent/SoftwareApplication.php';

class TestAgentEntities {
    public static function makePerson() {
        return (new Person('https://some-university.edu/user/554433'))
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime());
    }

    public static function makeMediaApplication() {
        return (new SoftwareApplication('https://com.sat/super-media-tool'))
            ->setName('Super Media Tool')
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime());
    }

    public static function makeReadingApplication() {
        return (new SoftwareApplication('https://github.com/readium/readium-js-viewer'))
            ->setName('Readium')
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime());
    }
}