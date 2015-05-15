<?php
require_once realpath(dirname(__FILE__) . '/../../../lib/CaliperSensor.php');
require_once 'Caliper/entities/DigitalResource.php';
require_once 'Caliper/entities/reading/EPubVolume.php';
require_once 'Caliper/entities/reading/EPubSubChapter.php';
require_once 'Caliper/entities/lis/CourseSection.php';
require_once 'Caliper/entities/agent/Organization.php';
require_once 'Caliper/entities/agent/Person.php';
require_once 'Caliper/entities/agent/SoftwareApplication.php';
require_once 'Caliper/events/ViewedEvent.php';
require_once 'Caliper/entities/reading/WebPage.php';

class ViewedEventTest extends PHPUnit_Framework_TestCase {

    private $viewedEvent;

    function  setUp() {
        $now = new DateTime('2015-09-02T11:30:00.000Z');

        $americanHistoryCourse = new CourseSection('https://some-university.edu/politicalScience/2014/american-revolution-101');
        $americanHistoryCourse->setCourseNumber('AmRev-101')
            ->setDateModified($now);

        $readium = new SoftwareApplication('https://github.com/readium/readium-js-viewer');
        $readium->setDateModified($now);

        $alice = new Person('https://some-university.edu/students/jones-alice-554433');
        $alice->setDateModified($now);

        $readiumReading = new EPubVolume('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3)');
        $readiumReading->setName('The Glorious Cause: The American Revolution, 1763-1789 (Oxford History of the United States)')
            ->setDateModified($now);

        $readiumReadingPage1 = new EPubSubChapter('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3)/1');
        $readiumReadingPage1->setName('Key Figures: George Washington)')
            ->setDateModified($now);

        $viewedEvent = new ViewedEvent();
        $viewedEvent->setActor($alice)
            ->setObject($readiumReadingPage1)
            ->setEdApp($readium)
            ->setStartedAtTime($now);

        $this->viewedEvent = $viewedEvent;
    }

    function testViewedEventSerializesToJSON() {
        $this->assertJsonStringEqualsJsonFile(dirname(dirname(__FILE__)) . '/../resources/fixtures/ViewedEvent.json', json_encode($this->viewedEvent, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

    }
}