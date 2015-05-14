<?php
require_once 'Annotation.php';

class BookmarkAnnotation extends Annotation implements JsonSerializable {

    private $bookmarkNotes;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType('http://purl.imsglobal.org/caliper/v1/BookmarkAnnotation');
    }

    public function jsonSerialize() {
        return [
            '@id' => $this->getId(),
            '@type' => $this->getType(),
            'lastModifiedTime' => $this->getDateModified(),
            'properties' => (object) $this->getExtensions(),
            'target' => $this->getTarget(),
            'bookmarkNotes' => $this->getBookmarkNotes(),
        ];
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
        return $this;
    }
}
