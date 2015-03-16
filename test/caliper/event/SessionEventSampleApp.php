<?php
require_once realpath(dirname(__FILE__) . '/../../../lib/CaliperSensor.php');
require_once 'Caliper/entities/reading/EPubVolume.php';
require_once 'Caliper/entities/reading/EPubSubChapter.php';
require_once 'Caliper/entities/lis/LISPerson.php';
require_once 'Caliper/entities/SoftwareApplication.php';
require_once 'Caliper/entities/Session.php';
require_once 'Caliper/events/SessionEvent.php';
require_once 'Caliper/actions/SessionActions.php';

class SessionEventSampleApp {
	private $sessionEvent;

    /**
     * @return mixed
     */
    public function getSessionEvent()
    {
        return $this->sessionEvent;
    }
	
	function setUp() {
        $createdTime = new DateTime('2015-01-01T06:00:00.000Z');
        $modifiedTime = new DateTime('2015-02-02T11:30:00.000Z');
        $sessionStartTime = new DateTime('2015-02-15T10:15:00.000Z');

        $actor = new LISPerson('https://some-university.edu/user/554433');
        $actor->setDateCreated($createdTime);
        $actor->setDateModified($modifiedTime);

        $action = SessionActions::LOGGED_IN;

		$eventObj = new SoftwareApplication('https://github.com/readium/readium-js-viewer');
		$eventObj->setName('Readium');
		// TODO remove this setType?  it's from original ViewedEventTest.php
		$eventObj->setType('http://purl.imsglobal.org/caliper/v1/SoftwareApplication');
        $eventObj->setDateCreated($createdTime);
        $eventObj->setDateModified($modifiedTime);

		$ePubVolume = new EPubVolume('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3)');	
		$ePubVolume->setType('http://www.idpf.org/epub/vocab/structure/#volume');
		$ePubVolume->setName('The Glorious Cause: The American Revolution, 1763-1789 (Oxford History of the United States)');
        $ePubVolume->setDateCreated($createdTime);
        $ePubVolume->setDateModified($modifiedTime);

		// TODO Implement Frame.  JS test uses Frame.  PHP library doesn't have it.
		$targetObj = new EPubSubChapter('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3/1)');
		$targetObj->setType('http://purl.imsglobal.org/caliper/v1/Frame');
		$targetObj->setName('Key Figures: George Washington');
        $targetObj->setDateCreated($createdTime);
        $targetObj->setDateModified($modifiedTime);
        $targetObj->setIsPartOf($ePubVolume);
		$targetObj->setIndex(1);

		$generatedObj = new Session('https://github.com/readium/session-123456789');
		$generatedObj->setName('session-123456789');
        $generatedObj->setDateCreated($createdTime);
        $generatedObj->setDateModified($modifiedTime);
        $generatedObj->setActor($actor);
        $generatedObj->setStartedAtTime($sessionStartTime);

        $edApp = null;
		$org = null;

		$sessionEvent = new SessionEvent();	
		$sessionEvent->setActor($actor);
		$sessionEvent->setAction($action);
		$sessionEvent->setObject($eventObj);
		$sessionEvent->setTarget($targetObj);
		$sessionEvent->setGenerated($generatedObj);
		$sessionEvent->setEdApp($edApp);
		$sessionEvent->setLisOrganization($org);
        $sessionEvent->setStartedAtTime($sessionStartTime);

        $this->sessionEvent = $sessionEvent;
	}
	
	 function getSessionEventJSON() {
	 	return json_encode($this->sessionEvent, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	 }
}

/*
 * NOTE: Go to http://request.bin/, create a new RequestBin,
 * copy the bin ID (the last part of the bin's URL, including
 * the "/"), and put it in the 'sendURI' option below.
 */
Caliper::init('org.imsglobal.caliper.php.apikey', [
    'host' => 'requestb.in',
    'port' => 80,
    'sendURI' => '/1234abc5',
]);

$sessionTest = new SessionEventSampleApp();
$sessionTest->setUp();

Caliper::send($sessionTest->getSessionEvent());
