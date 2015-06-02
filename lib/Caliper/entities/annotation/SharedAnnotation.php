<?php
require_once 'Annotation.php';
require_once 'AnnotationType.php';

class SharedAnnotation extends Annotation {
    /** @var \foaf\Agent[] */
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

    /** @return \foaf\Agent[] withAgents */
    public function getWithAgents() {
        return $this->withAgents;
    }

    /**
     * @param \foaf\Agent|\foaf\Agent[] $withAgents
     * @return $this|SharedAnnotation
     */
    public function setWithAgents($withAgents) {
        if (!is_array($withAgents)) {
            $withAgents = [$withAgents];
        }

        foreach ($withAgents as $aWithAgents) {
            if (!is_a($aWithAgents, \foaf\Agent::class)) {
                throw new InvalidArgumentException(__METHOD__ . ': array of ' . \foaf\Agent::class . ' expected');
            }
        }

        $this->withAgents = $withAgents;
        return $this;
    }
}
