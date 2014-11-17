<?php
/**
 * Created by PhpStorm.
 * User: pnayak
 * Date: 11/1/14
 * Time: 6:27 PM
 */

require_once dirname(__FILE__) . '/../assignable/AssignableDigitalResource.php';
require_once dirname(__FILE__) . '/../qti/QTIAssessmentItem.php';


class AssessmentItem extends AssignableDigitalResource implements QTIAssessmentItem, JsonSerializable {

    public function __construct($id) {
        parent::__construct($id);
        $this->setId($id);
        $this->setType('http://purl.imsglobal.org/caliper/v1/AssessmentItem');
    }

    public function jsonSerialize() {
        return ['@id' => $this->getId(),
            '@type' => $this->getType(),
            'name' => $this->getName(),
            'objectType' => $this->getObjectType(),
            'alignedLearningObjective' => $this->getAlignedLearningObjectives(),
            'keyword' => $this->getKeywords(),
            'partOf' => $this->getParentRef(),
            'lastModifiedTime' => $this->getLastModifiedAt(),
            'dateCreated' => $this->getDateCreated(),
            'datePublished' => $this->getDatePublished(),
            'dateToActivate' => $this->getDateToActivate(),
            'dateToShow' => $this->getDateToShow(),
            'dateToStartOn' => $this->getDateToStartOn(),
            'dateToSubmit' => $this->getDateToSubmit(),
            'maxAttempts' => $this->getMaxAttempts(),
            'maxScore' => $this->getMaxScore()];
    }
}