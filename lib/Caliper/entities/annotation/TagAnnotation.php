<?php
require_once 'Annotation.php';
require_once 'AnnotationType.php';

class TagAnnotation extends Annotation {
    /** @var array */
    public $tags = [];

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(AnnotationType::TAG_ANNOTATION);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'tags' => $this->getTags(),
        ]);
    }

    /** @return array tags */
    public function getTags() {
        return $this->tags;
    }

    /**
     * @param array $tags
     * @return $this|TagAnnotation
     */
    public function setTags($tags) {
        if (!is_array($tags)) {
            $tags = [$tags];
        }

        $this->tags = $tags;
        return $this;
    }

}
