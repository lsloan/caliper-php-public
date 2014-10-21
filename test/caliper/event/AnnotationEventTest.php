<?php

require_once(dirname(__FILE__) . '/../../../lib/CaliperSensor.php');
require_once dirname(__FILE__).'/../../../lib/Caliper/entities/reading/EPubVolume.php';
require_once dirname(__FILE__) . '/../../../lib/Caliper/entities/reading/EPubSubChapter.php';
require_once (dirname(__FILE__).'/../../../lib/Caliper/entities/lis/LISPerson.php');
require_once (dirname(__FILE__).'/../../../lib/Caliper/entities/lis/LISCourseSection.php');
require_once (dirname(__FILE__) .'/../../../lib/Caliper/entities/SoftwareApplication.php');
require_once (dirname(__FILE__).'/../../../lib/Caliper/entities/annotation/HighlightedAnnotation.php');
require_once (dirname(__FILE__).'/../../../lib/Caliper/entities/annotation/BookmarkAnnotation.php');
require_once (dirname(__FILE__).'/../../../lib/Caliper/entities/annotation/SharedAnnotation.php');
require_once (dirname(__FILE__).'/../../../lib/Caliper/entities/annotation/TagAnnotation.php');
require_once (dirname(__FILE__).'/../../../lib/Caliper/entities/annotation/TextPositionSelector.php');
require_once (dirname(__FILE__) .'/../../../lib/Caliper/events/annotation/AnnotationEvent.php');

/**
 *@author balachandiran.v
 *
 */
class AnnotationEventTest extends PHPUnit_Framework_TestCase {

	private $highlightedAnnotationEvent;
	private $bookmarkAnnotationEvent;
	private $sharedAnnotationEvent;
	private $tagAnnotationEvent;
	


	public function setUp()  {
				
		$now=1401216031920;
		
		$americanHistoryCourse = new LISCourseSection('https://some-university.edu/politicalScience/2014/american-revolution-101',null);
		$americanHistoryCourse->setCourseNumber("AmRev-101");
		$americanHistoryCourse->setLabel("American Revolution 101");
		$americanHistoryCourse->setSemester("Spring-2014");
		$americanHistoryCourse->setLastModifiedAt($now);		

		
		// edApp that provides the first reading
		$readium = new SoftwareApplication(
				"https://github.com/readium/readium-js-viewer");
		$readium->setType("http://purl.imsglobal.org/ctx/caliper/v1/edApp/epub-reader");
		$readium->setLastModifiedAt($now);
		
		// edApp that provides the second reading
		$courseSmart = new SoftwareApplication(
				"http://www.coursesmart.com/reader");
		$courseSmart->setType("http://purl.imsglobal.org/ctx/caliper/v1/edApp/epub-reader");
		$courseSmart->setLastModifiedAt($now);
		
		// Student - performs interaction with reading activities
		$alice = new LISPerson("https://some-university.edu/students/jones-alice-554433");
		$alice->setLastModifiedAt($now);
		
		
		
		// ----------------------------------------------------------------
		// Step 2: Set up activity context elements (i.e. the two Readings)
		// ----------------------------------------------------------------
		$readiumReading = new EPubVolume("https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3)");
		$readiumReading->setName("The Glorious Cause: The American Revolution, 1763-1789 (Oxford History of the United States)");
		$readiumReading->setLastModifiedAt($now);
		$readiumReading->setLanguage('English');
		
		
		$readiumReadingPage1 = new EPubSubChapter("https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3)/1");
		$readiumReadingPage1->setName("Key Figures: George Washington)");
		$readiumReadingPage1->setLastModifiedAt($now);
		$readiumReading->setLanguage("English");
		$readiumReadingPage1->setParentRef($readiumReading);
		
		$readiumReadingPage2 = new EPubSubChapter("https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3)/2");
		$readiumReadingPage2->setName("Key Figures: Lord Cornwalis)");
		$readiumReadingPage2->setLastModifiedAt($now);
		$readiumReading->setLanguage("English");
		$readiumReadingPage2->setParentRef($readiumReading);
		
		$readiumReadingPage3 = new EPubSubChapter("https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3)/3");
		$readiumReadingPage3->setName("Key Figures: Paul Revere)");
		$readiumReadingPage3->setLastModifiedAt($now);
		$readiumReading->setLanguage("English");
		$readiumReadingPage3->setParentRef($readiumReading);
		
		// ........................................................................
		
		$courseSmartReading = new EPubVolume("http://www.coursesmart.com/the-american-revolution-a-concise-history/robert-j-allison/dp/9780199347322");
		$courseSmartReading->setName("The American Revolution: A Concise History | 978-0-19-531295-9");
		$courseSmartReading->setLastModifiedAt($now);
		$courseSmartReading->setLanguage("English");
		
		$courseSmartReadingPageaXfsadf12 = new EPubSubChapter("http://www.coursesmart.com/the-american-revolution-a-concise-history/robert-j-allison/dp/9780199347322/aXfsadf12");
		$courseSmartReadingPageaXfsadf12->setName("The Boston Tea Party");
		$courseSmartReading->setLastModifiedAt($now);
		$courseSmartReadingPageaXfsadf12->setLanguage("English");
		$courseSmartReadingPageaXfsadf12->setParentRef($courseSmartReading);
		
		echo ">> generated activity context data<br/>";
		
		// ----------------------------------------------------------------
		// Step 3: Populate Global App State for Event Generator
		// ----------------------------------------------------------------
		
		$globalAppState = [	'currentCourse'=>$americanHistoryCourse,
							'readiumEdApp'=>$readium,
							'readiumReading'=>$readiumReading,
							'readiumReadingPage1'=>$readiumReadingPage1,
							'readiumReadingPage2'=>$readiumReadingPage2,
							'readiumReadingPage3'=>$readiumReadingPage3,
							'coursesmartEdApp'=>$courseSmart,
							'coursesmartReading'=>$courseSmartReading,
							'coursesmartReadingPageaXfsadf12'=>$courseSmartReadingPageaXfsadf12,
							'student'=>$alice
							];
		
		$this->highlightedAnnotationEvent=$this->hilightTermsInReading($globalAppState, "readium", "2", 455, 489,$now); 
		$this->bookmarkAnnotationEvent=$this->bookmarkPageInReading($globalAppState, "readium", "3",$now);
		$this->tagAnnotationEvent=$this->tagPageInReading($globalAppState, "coursesmart", "aXfsadf12",array("to-read", "1776","shared-with-project-team"),$now);
		$this->sharedAnnotationEvent=$this->sharePageInReading($globalAppState,"coursesmart","aXfsadf12"
				,array("https://some-university.edu/students/smith-bob-554433","https://some-university.edu/students/lam-eve-554433"),$now);

		
	}


	public function testHighlightedAnnotationEventSerializesToJSON(){

		$this->assertJsonStringEqualsJsonFile(dirname(dirname(__FILE__)).'/../resources/fixtures/HighlightedAnnotationEvent.json',
				json_encode($this->highlightedAnnotationEvent,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
	}
	public function testBookmarkAnnotationEventSerializesToJSON(){
	
		$this->assertJsonStringEqualsJsonFile(dirname(dirname(__FILE__)).'/../resources/fixtures/BookmarkAnnotationEvent.json',
				json_encode($this->bookmarkAnnotationEvent,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
	}
	
	public function testSharedAnnotationEventSerializesToJSON(){
	
		$this->assertJsonStringEqualsJsonFile(dirname(dirname(__FILE__)).'/../resources/fixtures/SharedAnnotationEvent.json',
				json_encode($this->sharedAnnotationEvent,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
	}
	
	public function testTagAnnotationEventSerializesToJSON(){
	
		$this->assertJsonStringEqualsJsonFile(dirname(dirname(__FILE__)).'/../resources/fixtures/TagAnnotationEvent.json',
				json_encode($this->tagAnnotationEvent,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
	}
	

		
	
	function  hilightTermsInReading($globalAppState,$edApp,$pageId,$startIndex,$endIndex,$now) {
	
		$hilightTermsEvent = AnnotationEvent::forAction("highlighted");
	
		// action is set in navEvent constructor... now set actor and object
		$hilightTermsEvent->setActor($globalAppState["student"]);
		
		$hilightTermsEvent->setObject($globalAppState[$edApp."ReadingPage".$pageId]);
	
		// set target of highlight create action
		$hilightTermsEvent->setGenerated($this->getHighlight($startIndex,$endIndex,"Life, Liberty and the pursuit of Happiness",$globalAppState[$edApp."ReadingPage".$pageId]));
	
		// add (learning) context for event
		$hilightTermsEvent->setEdApp($globalAppState[$edApp."EdApp"]);
		$hilightTermsEvent->setLisOrganization($globalAppState["currentCourse"]);
	
		// set time and any event specific properties
		$hilightTermsEvent->setStartedAt($now);
		
		return $hilightTermsEvent;
	}
	
	/**
	 * @param endIndex
	 * @param startIndex
	 * @return
	 */
	function  getHighlight($startIndex, $endIndex,$selectionText,$target) {
	
		$baseUrl = "https://someEduApp.edu/highlights/";
		$randomUUID = 'b24b57d2-d715-4d82-98cf-06af3089cfbb';//uniqid(uniqid(), true);
		$highlightAnnotation = new HighlightAnnotation($baseUrl.$randomUUID);
		$textPositionSelector = new TextPositionSelector();
		$textPositionSelector->setStart($startIndex);
		$textPositionSelector->setEnd($endIndex);
		$highlightAnnotation->setSelection($textPositionSelector);
		$highlightAnnotation->setSelectionText($selectionText);
		$highlightAnnotation->setTarget($target);
		return $highlightAnnotation;
	}
	
	function  bookmarkPageInReading($globalAppState,$edApp,$pageId,$now) {
	
		$bookmarkPageEvent = AnnotationEvent::forAction("bookmarked");
	
		// action is set in navEvent constructor... now set actor, object
		$bookmarkPageEvent->setActor($globalAppState["student"]);
		$bookmarkPageEvent->setObject($globalAppState[$edApp."ReadingPage".$pageId]);
	
		// bookmark create action generates a BookmarkAnnotation
		$bookmarkPageEvent->setGenerated($this->getBookmark($globalAppState[$edApp."ReadingPage".$pageId]));
	
		// add (learning) context for event
		$bookmarkPageEvent->setEdApp($globalAppState[$edApp."EdApp"]);
		$bookmarkPageEvent->setLisOrganization($globalAppState["currentCourse"]);
	
		// set time and any event specific properties
		$bookmarkPageEvent->setStartedAt($now);
	
		return $bookmarkPageEvent;
	}
	
	/**
	 *
	 * @param mixed $target
	 * @return BookmarkAnnotation
	 */
	function  getBookmark($target) {
	
		$baseUrl = "https://someEduApp.edu/bookmarks/";
		$randomUUID = '2bb58ace-12fe-4e8b-b783-5733b87f9a16';//uniqid(uniqid(), true);
		$bookmarkAnnotation = new BookmarkAnnotation($baseUrl.$randomUUID);
		$bookmarkAnnotation->setTarget($target);
		return $bookmarkAnnotation;
	}
	
	function tagPageInReading($globalAppState,$edApp,$pageId,$tags,$now) {
	
		$tagPageEvent = AnnotationEvent::forAction("tagged");
	
		// action is set in navEvent constructor... now set actor and object
		$tagPageEvent->setActor($globalAppState["student"]);
		$tagPageEvent->setObject($globalAppState[$edApp."ReadingPage".$pageId]);
	
		// tag create action generates a TagAnnotation
		$tagPageEvent->setGenerated($this->getTag($tags,$globalAppState[$edApp."ReadingPage".$pageId]));
	
		// add (learning) context for event
		$tagPageEvent->setEdApp($globalAppState[$edApp."EdApp"]);
		$tagPageEvent->setLisOrganization($globalAppState["currentCourse"]);
	
		// set time and any event specific properties
		$tagPageEvent->setStartedAt($now);
	
		return $tagPageEvent;
	}
	/**
	 *
	 * @param mixed $tags
	 * @param mixed $target
	 * @return TagAnnotation
	 */
	function  getTag($tags, $target) {
	
		$baseUrl = "https://someEduApp.edu/tags/";
		$randomUUID = '822f7272-7501-49ae-b537-f27c98145906';//uniqid(uniqid(), true);
		$tagAnnotation = new TagAnnotation($baseUrl.$randomUUID);
		$tagAnnotation->setTags($tags);
		$tagAnnotation->setTarget($target);
		return $tagAnnotation;
	}
	
	function  sharePageInReading($globalAppState,$edApp,$pageId,$sharedWithIds,$now) {
	
		$sharePageEvent = AnnotationEvent::forAction("shared");
	
		// action is set in navEvent constructor... now set actor and object
		$sharePageEvent->setActor($globalAppState["student"]);
		$sharePageEvent->setObject($globalAppState[$edApp."ReadingPage".$pageId]);
	
		// tag create action generates a SharedAnnotation
		$sharePageEvent->setGenerated($this->getShareAnnotation($sharedWithIds,$globalAppState[$edApp."ReadingPage".$pageId]));
	
		// add (learning) context for event
		$sharePageEvent->setEdApp($globalAppState[$edApp."EdApp"]);
		$sharePageEvent->setLisOrganization($globalAppState["currentCourse"]);
	
		// set time and any event specific properties
		$sharePageEvent->setStartedAt($now);
	
		return $sharePageEvent;
	}
	/**
	 *
	 * @param mixed $sharedWithIds
	 * @param mixed $target
	 * @return SharedAnnotation
	 */
	function  getShareAnnotation($sharedWithIds,$target) {
	
		$baseUrl = "https://someBookmarkingApp.edu/shares/";
		$randomUUID = 'fd4c6117-4316-4ff9-a0c1-247945fb2573';//uniqid(uniqid(), true);
		$sharedAnnotation = new SharedAnnotation($baseUrl.$randomUUID);
		$sharedAnnotation->setUsers($sharedWithIds);
		$sharedAnnotation->setTarget($target);
		return $sharedAnnotation;
	}
	
	
	
	
}