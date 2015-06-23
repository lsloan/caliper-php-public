<?php
require_once realpath(dirname(__FILE__) . '/../lib/Caliper/Sensor.php');
require_once 'Caliper/entities/reading/EPubVolume.php';
require_once 'Caliper/entities/reading/EPubSubChapter.php';
require_once 'Caliper/entities/reading/Frame.php';
require_once 'Caliper/entities/agent/Person.php';
require_once 'Caliper/entities/agent/SoftwareApplication.php';
require_once 'Caliper/entities/session/Session.php';
require_once 'Caliper/events/SessionEvent.php';
require_once 'Caliper/actions/Action.php';
require_once 'Caliper/entities/EntityType.php';
require_once 'Caliper/Options.php';

class SessionEventSampleApp {
    /** @var SessionEvent */
    private $sessionEvent;
    /** @var Person */
    private $personEntity;

    /** @return Person */
    public function getPersonEntity() {
        return $this->personEntity;
    }

    /** @return SessionEvent */
    public function getSessionEvent() {
        return $this->sessionEvent;
    }

    function setUp() {
        $createdTime = new DateTime('2015-01-01T06:00:00.000Z');
        $modifiedTime = new DateTime('2015-02-02T11:30:00.000Z');
        $sessionStartTime = new DateTime('2015-02-15T10:15:00.000Z');

        $person = new Person('https://some-university.edu/user/554433');
        $person->setDateCreated($createdTime)
            ->setDateModified($modifiedTime);
        $this->personEntity = $person;

        $eventObj = new SoftwareApplication('https://github.com/readium/readium-js-viewer');
        $eventObj->setName('Readium')
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime);

        $ePubVolume = new EPubVolume('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3)');
        $ePubVolume->setName('The Glorious Cause: The American Revolution, 1763-1789 (Oxford History of the United States)')
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime);

		$targetObj = new Frame('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3/1)');
        $targetObj->setName('Key Figures: George Washington')
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime)
            ->setIsPartOf($ePubVolume)
            ->setIndex(1);

        $generatedObj = new Session('https://github.com/readium/session-123456789');
        $generatedObj->setName('session-123456789')
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime)
            ->setActor($person)
            ->setStartedAtTime($sessionStartTime);

        $sessionEvent = new SessionEvent();
        $sessionEvent->setAction(new Action(Action::LOGGED_IN))
            ->setActor($person)
            ->setObject($eventObj)
            ->setTarget($targetObj)
            ->setGenerated($generatedObj)
            ->setStartedAtTime($sessionStartTime);

        $this->sessionEvent = $sessionEvent;
    }
}

$sensor = new Sensor('id');

$options = (new Options())
    ->setApiKey('org.imsglobal.caliper.php.apikey')
    ->setDebug(true)
    ->setHost('http://localhost:8000/');

$sensor->registerClient('http', new Client('clientId', $options));

$sessionTest = new SessionEventSampleApp();
$sessionTest->setUp();

echo "sending...\r";
$sensor->send($sensor, $sessionTest->getSessionEvent());
echo "send() done\n";

echo "describing...\r";
$sensor->describe($sensor, $sessionTest->getPersonEntity());
echo "describe() done\n";