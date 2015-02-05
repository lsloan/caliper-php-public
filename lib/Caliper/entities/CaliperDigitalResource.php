<?php
$caliperLibDir = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR;

require_once($caliperLibDir . 'Caliper/entities/CaliperEntity.php');

/**
 *         Caliper representation of a CreativeWork
 *         (https://schema.org/CreativeWork)
 *
 *         We add on learning specific attributes, including a list of
 *         {@link LearningObjective} learning objectives and a list of
 *         {@link String} keywords
 *
 *         In addition, we add a the following attributes:
 *
 *         name (https://schema.org/name) -the name of the resource,
 *
 *         about (https://schema.org/about) - the subject matter of the resource
 *
 *         language (https://schema.org/Language) - Natural languages such as
 *         Spanish, Tamil, Hindi, English, etc. and programming languages such
 *         as Scheme and Lisp
 *
 */
class CaliperDigitalResource extends CaliperEntity implements JsonSerializable {

    private $objectType = [];
    private $parentRef;
    private $alignedLearningObjectives = array();
    private $keywords = array();

    public function __construct() {
        parent::__construct();
    }

    /**
     ** @see JsonSerializable::jsonSerialize()
     *to implement jsonLD
     */

    public function jsonSerialize() {

        return ['@id' => $this->getId(),
            '@type' => $this->getType(),
            'name' => $this->getName(),
            'objectType' => $this->getObjectType(),
            'properties'=>(object) $this->getProperties(),
            'alignedLearningObjective' => $this->getAlignedLearningObjectives(),
            'keyword' => $this->getKeywords(),
            'partOf' => $this->getParentRef(),
            'lastModifiedTime' => $this->getLastModifiedAt()
        ];
    }

    /**
     * @return mixed
     */
    public function getObjectType() {
        return $this->objectType;
    }

    /**
     * @param mixed $objectType
     */
    public function setObjectType($objectType) {
        $this->objectType = $objectType;
    }

    /**
     * @return the alignedLearningObjectives
     */
    public function  getAlignedLearningObjectives() {
        return $this->alignedLearningObjectives;
    }

    /**
     * @param alignedLearningObjectives the alignedLearningObjectives to set
     */
    public function setAlignedLearningObjectives($alignedLearningObjectives) {
        $this->alignedLearningObjectives = $alignedLearningObjectives;
    }

    /**
     * @return the keywords
     */
    public function  getKeywords() {
        return $this->keywords;
    }

    /**
     * @param keywords the keywords to set
     */
    public function setKeywords($keywords) {
        $this->keywords = $keywords;
    }

    /**
     * @return the parentRef
     */
    public function getParentRef() {
        return $this->parentRef;
    }

    /**
     * @param parentRef the parentRef to set
     */
    public function setParentRef($parentRef) {
        $this->parentRef = $parentRef;
    }
}
