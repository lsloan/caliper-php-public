<?php

require_once 'Annotation.php';
/**
 * 
 *
 */
class BookmarkAnnotation extends Annotation {

	private $bookmarkNotes;

	public function __construct($id){
		parent::__construct($id);
		$this->setType("http://purl.imsglobal.org/caliper/v1/BookmarkAnnotation");
	}

	/**
	 * @return the bookmarkNotes
	 */
	public function  getBookmarkNotes() {
		return $this->bookmarkNotes;
	}

	/**
	 * @param bookmarkNotes
	 *            the bookmarkNotes to set
	 */
	public function  setBookmarkNotes($bookmarkNotes) {
		$this->bookmarkNotes = $bookmarkNotes;
	}
}
