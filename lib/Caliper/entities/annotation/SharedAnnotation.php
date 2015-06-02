<?php
require_once 'Annotation.php';
require_once 'AnnotationType.php';

class SharedAnnotation extends Annotation {
    /** @var Agent[] */
    public $withAgents = [];

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new AnnotationType(AnnotationType::SHARED_ANNOTATION));
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'withAgents' => $this->getWithAgents(),
        ]);
    }

    /** @return Agent[] withAgents */
    public function getWithAgents() {
        return $this->withAgents;
    }

    /**
     * @param Agent[] $withAgents
     * @return $this|SharedAnnotation
     */
    public function setWithAgents($withAgents) {
        if (!is_array($withAgents)) {
            $withAgents = [$withAgents];
        }

        $this->withAgents = $withAgents;
        return $this;
    }
}
