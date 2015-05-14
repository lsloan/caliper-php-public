<?php
require_once realpath(dirname(__FILE__) . '/../lib/CaliperSensor.php');
require_once 'Caliper/entities/reading/EPubVolume.php';
require_once 'Caliper/entities/reading/EPubSubChapter.php';
require_once 'Caliper/entities/lis/LISPerson.php';
require_once 'Caliper/entities/SoftwareApplication.php';
require_once 'Caliper/entities/Session.php';
require_once 'Caliper/events/SessionEvent.php';
require_once 'Caliper/actions/Action.php';
require_once 'Caliper/entities/CaliperEntityTypes.php';

class SessionEventSampleApp {
    private $sessionEvent;

    /**
     * @return mixed
     */
    public function getSessionEvent() {
        return $this->sessionEvent;
    }

    function setUp() {
        $createdTime = new DateTime('2015-01-01T06:00:00.000Z');
        $modifiedTime = new DateTime('2015-02-02T11:30:00.000Z');
        $sessionStartTime = new DateTime('2015-02-15T10:15:00.000Z');

        $actor = new LISPerson('https://some-university.edu/user/554433');
        $actor->setDateCreated($createdTime)
            ->setDateModified($modifiedTime);

        $eventObj = new SoftwareApplication('https://github.com/readium/readium-js-viewer');
        $eventObj->setName('Readium')
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime);

        $ePubVolume = new EPubVolume('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3)');
        $ePubVolume->setName('The Glorious Cause: The American Revolution, 1763-1789 (Oxford History of the United States)')
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime);

        // TODO Implement Frame.  JS test uses Frame.  PHP library doesn't have it.
        $targetObj = new EPubSubChapter('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3/1)');
        $targetObj->setType(CaliperEntityTypes::FRAME)
            ->setName('Key Figures: George Washington')
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime)
            ->setIsPartOf($ePubVolume)
            ->setIndex(1);

        $generatedObj = new Session('https://github.com/readium/session-123456789');
        $generatedObj->setName('session-123456789')
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime)
            ->setActor($actor)
            ->setStartedAtTime($sessionStartTime);

        $sessionEvent = new SessionEvent();
        $sessionEvent->setAction(Action::LOGGED_IN)
            ->setActor($actor)
            ->setObject($eventObj)
            ->setTarget($targetObj)
            ->setGenerated($generatedObj)
            ->setStartedAtTime($sessionStartTime);

        $this->sessionEvent = $sessionEvent;
    }
}

Caliper::init('org.imsglobal.caliper.php.apikey', [
    'debug' => true,
    'host' => 'localhost',
    'port' => 8000,
    'sendURI' => '/',
]);

$sessionTest = new SessionEventSampleApp();
$sessionTest->setUp();

Caliper::send($sessionTest->getSessionEvent());
