<?php
if (!defined('CALIPER_LIB_PATH')) {
    throw new Exception('Please require CaliperSensor first.');
}

require_once 'Caliper/entities/CaliperEntity.php';

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

    private $objectTypes = [];
    private $alignedLearningObjectives = [];
    private $keywords = [];
    private $isPartOf;
    private $datePublished;

    public function __construct() {
        parent::__construct();
    }

    /**
     ** @see JsonSerializable::jsonSerialize()
     *to implement jsonLD
     */

    public function jsonSerialize() {
        return [
            '@id' => $this->getId(),
            '@type' => $this->getType(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            
            'objectType' => $this->getObjectTypes(),
            'alignedLearningObjective' => $this->getAlignedLearningObjectives(),
            'keywords' => $this->getKeywords(),
            'isPartOf' => $this->getIsPartOf(),
            'properties' => (object) $this->getProperties(),
            'dateCreated' => $this->getDateCreated(),
            'dateModified' => $this->getDateModified(),
            'datePublished' => $this->getDatePublished(),
        ];
    }

    /**
     * @return mixed
     */
    public function getObjectTypes() {
        return $this->objectTypes;
    }

    /**
     * @param mixed $objectTypes
     */
    public function setObjectTypes($objectTypes) {
        $this->objectType = $objectTypes;
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
     * @return the isPartOf
     */
    public function getIsPartOf() {
        return $this->isPartOf;
    }

    /**
     * @param isPartOf the isPartOf to set
     */
    public function setIsPartOf($isPartOf) {
        $this->isPartOf = $isPartOf;
    }
    
    /**
     * @return the datePublished
     */
    public function getDatePublished() {
        return $this->datePublished;
    }

    /**
     * @param datePublished the datePublished to set
     */
    public function setDatePublished($datePublished) {
        $this->datePublished = $datePublished;
    }
}
