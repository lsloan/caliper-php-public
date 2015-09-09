<?php
require_once realpath(dirname(__FILE__) . '/../CaliperTestCase.php');
require_once 'Caliper/events/NavigationEvent.php';

/**
 * @requires PHP 5.4
 */
class HttpRequestorTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setFixtureFilename('/../../caliper-common-fixtures/src/test/resources/fixtures/eventStorePayload.json');

        $this->setTestObject(TestRequests::makeEnvelope()
            ->setData((new NavigationEvent())
                ->setActor(TestAgentEntities::makePerson())
                ->setMembership(TestLisEntities::makeMembership())
                ->setObject(TestReadingEntities::makeEPubVolume())
                ->setNavigatedFrom(TestReadingEntities::makeWebPage())
                ->setEdApp(TestAgentEntities::makeReadingApplication())
                ->setTarget(TestReadingEntities::makeFrame1())
                ->setGroup(TestLisEntities::makeGroup())
                ->setEventTime(TestTimes::startedTime())
                ->setFederatedSession(new Session('https://example.edu/lms/federatedSession/123456789'))));
    }
}