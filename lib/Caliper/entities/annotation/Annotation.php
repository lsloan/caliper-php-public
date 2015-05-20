<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/Entity.php';
require_once 'Caliper/entities/EntityType.php';
require_once 'Caliper/entities/Generatable.php';

/**
 *         The super-class of all Annotation types.
 *
 *         Direct sub-types can include - Hilight, Attachment, etc. - all of
 *         which are specified in the Caliper Annotation Metric Profile
 *
 */
class Annotation extends Entity implements Generatable {
    private $annotated;

    public function  __construct($id) {
        $this->setId($id);
        $this->setType(EntityType::ANNOTATION);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'annotated' => $this->getAnnotated(),
        ]);
    }

    /**
     * @return the annotated
     */
    public function  getAnnotated() {
        return $this->annotated;
    }

    /**
     * @param $annotated
     *            the annotated to set
     */
    public function setAnnotated($annotated) {
        $this->annotated = $annotated;
        return $this;
    }
}

