<?php
require_once 'Caliper/entities/Entity.php';
require_once 'Caliper/entities/EntityType.php';
require_once 'Caliper/entities/Generatable.php';

/**
 *         The super-class of all Annotation types.
 *
 *         Direct sub-types can include - Highlight, Attachment, etc. - all of
 *         which are specified in the Caliper Annotation Metric Profile
 *
 */
abstract class Annotation extends Entity implements Generatable {
    /** @var DigitalResource */
    private $annotated;

    public function  __construct($id) {
        parent::__construct($id);
        $this->setType(new EntityType(EntityType::ANNOTATION));
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'annotated' => (!is_null($this->getAnnotated()))
                ? $this->getAnnotated()->getId()
                : null,
        ]);
    }

    /** @return DigitalResource annotated */
    public function  getAnnotated() {
        return $this->annotated;
    }

    /**
     * @param DigitalResource $annotated
     * @return $this|Annotation
     */
    public function setAnnotated(DigitalResource $annotated) {
        $this->annotated = $annotated;
        return $this;
    }
}

