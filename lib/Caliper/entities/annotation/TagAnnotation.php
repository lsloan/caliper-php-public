<?php
require_once 'Annotation.php';

class TagAnnotation extends Annotation {

    public $tags = array();

    public function __construct($id) {
        parent::__construct($id);
        $this->setType('http://purl.imsglobal.org/caliper/v1/TagAnnotation');
    }

    public function jsonSerialize() {
        return [
            '@id' => $this->getId(),
            '@type' => $this->getType(),
            'lastModifiedTime' => $this->getDateModified(),
            'properties' => (object) $this->getExtensions(),
            'target' => $this->getTarget(),
            'tags' => $this->getTags(),
        ];
    }

    /**
     * @return the tags
     */
    public function getTags() {
        return $this->tags;
    }

    /**
     * @param tags
     *            the tags to set
     */
    public function setTags($tags) {
        $this->tags = $tags;
        return $this;
    }

}
