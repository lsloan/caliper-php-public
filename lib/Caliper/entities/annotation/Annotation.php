<?php

require_once dirname(__FILE__) . '/../Entity.php';
require_once dirname(__FILE__) . '/../schemadotorg/Thing.php';
require_once 'Caliper/entities/EntityType.php';

/**
 *         The super-class of all Annotation types.
 *
 *         Direct sub-types can include - Hilight, Attachment, etc. - all of
 *         which are specified in the Caliper Annotation Metric Profile
 *
 */
class Annotation extends Entity implements Thing, JsonSerializable {

    private $target;

    public function  __construct($id) {
        $this->setId($id);
        $this->setType(EntityType::ANNOTATION);
    }

    public function jsonSerialize() {
        return [
            '@id' => $this->getId(),
            '@type' => $this->getType(),
            'lastModifiedTime' => $this->getLastModifiedAt(),
            'properties' => (object) $this->getProperties(),
            'target' => $this->getTarget(),
        ];
    }

    /**
     * @return the target
     */
    public function  getTarget() {
        return $this->target;
    }

    /**
     * @param target
     *            the target to set
     */
    public function setTarget($target) {
        $this->target = $target;
        return $this;
    }
}

