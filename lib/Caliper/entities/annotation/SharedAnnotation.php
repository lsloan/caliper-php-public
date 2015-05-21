<?php
require_once 'Annotation.php';
require_once 'AnnotationType.php';

class SharedAnnotation extends Annotation {
    /** @var array */
    public $withAgents = [];

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(AnnotationType::SHARED_ANNOTATION);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'withAgents' => $this->getWithAgents(),
        ]);
    }

    /** @return array withAgents */
    public function getWithAgents() {
        return $this->withAgents;
    }

    /**
     * @param array $withAgents
     * @return $this|SharedAnnotation
     */
    public function setWithAgents($withAgents) {
        $this->withAgents = $withAgents;
        return $this;
    }
}
