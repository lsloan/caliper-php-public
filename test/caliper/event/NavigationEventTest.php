<?php

require_once  (dirname(__FILE__) .'/../../../lib/Caliper.php');
require_once (dirname(__FILE__) . '/../../../lib/Caliper/entities/CaliperDigitalResource.php');
require_once dirname(__FILE__) . '/../../../lib/Caliper/entities/reading/EPubVolume.php';
require_once (dirname(__FILE__) .'/../../../lib/Caliper/entities/lis/LISCourseSection.php');
require_once (dirname(__FILE__) .'/../../../lib/Caliper/entities/lis/LISOrganization.php');
require_once (dirname(__FILE__) .'/../../../lib/Caliper/entities/lis/LISPerson.php');
require_once (dirname(__FILE__) .'/../../../lib/Caliper/entities/SoftwareApplication.php');
require_once (dirname(__FILE__) .'/../../../lib/Caliper/events/reading/NavigationEvent.php');
require_once (dirname(__FILE__) .'/../../../lib/Caliper/entities/schemadotorg/WebPage.php');



/**
 * @author balachandiran.v
 *
 */
class NavigationEventTest extends PHPUnit_Framework_TestCase {
	
	private $navigationEvent;
	
    function  setUp()
	{
		
		$now = 1401216031920;
		$americanHistoryCourse = new LISCourseSection('https://some-university.edu/politicalScience/2014/american-revolution-101');
		$americanHistoryCourse->setCourseNumber("AmRev-101");
		$americanHistoryCourse->setLabel("American Revolution 101");
		$americanHistoryCourse->setSemester("Spring-2014");
		$americanHistoryCourse->setLastModifiedAt($now);
		
		$courseWebPage = new WebPage('AmRev-101-landingPage');
		$courseWebPage->setName("American Revolution 101 Landing Page");
		$courseWebPage->setParentRef($americanHistoryCourse);

		$readium = new SoftwareApplication("https://github.com/readium/readium-js-viewer");
		$readium->setType("http://purl.imsglobal.org/ctx/caliper/v1/edApp/epub-reader");
		$readium->setLastModifiedAt($now);
	
		$alice = new LISPerson("https://some-university.edu/students/jones-alice-554433");
		$alice->setLastModifiedAt($now);
		
		$readiumReading = new EPubVolume("https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3)");	
		$readiumReading->setName("The Glorious Cause: The American Revolution, 1763-1789 (Oxford History of the United States)");
		$readiumReading->setLastModifiedAt($now);
		$readiumReading->setLanguage('English');

		$navEvent = new NavigationEvent();	
		$navEvent->setActor( $alice);
		$navEvent->setObject($readiumReading);
		$navEvent->setFromResource($courseWebPage);
		$navEvent->setEdApp($readium);
		$navEvent->setLisOrganization($americanHistoryCourse);
		$navEvent->setStartedAt($now);		
	    
		$this->navigationEvent = $navEvent;
		
		
	}
	
	 function testNavigationEventSerializesToJSON(){	
		
	 	$this->assertJsonStringEqualsJsonFile(dirname(dirname(__FILE__)).'/../resources/fixtures/NavigationEvent.json',json_encode($this->navigationEvent,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
			
	 }
}