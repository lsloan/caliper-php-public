<?php
/**
 * Created by PhpStorm.
 * User: pnayak
 * Date: 11/7/14
 * Time: 5:56 PM
 */

require_once '/CaliperDigitalResource.php';

class AssignableDigitalResource extends CaliperDigitalResource implements JsonSerializable {

    private $dateCreated;
    private $datePublished;
    private $dateToActivate;
    private $dateToShow;
    private $dateToStartOn;
    private $dateToSubmit;
    private $maxAttempts;
    private $maxSubmits;
    private $maxScore;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType('http://purl.imsglobal.org/caliper/v1/AssignableDigitalResource');
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
            'maxScore' => $this->getMaxScore()
        ];
    }

    /**
     * @return mixed
     */
    public function getDateCreated() {
        return $this->dateCreated;
    }

    /**
     * @param mixed $dateCreated
     */
    public function setDateCreated($dateCreated) {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return mixed
     */
    public function getDatePublished() {
        return $this->datePublished;
    }

    /**
     * @param mixed $datePublished
     */
    public function setDatePublished($datePublished) {
        $this->datePublished = $datePublished;
    }

    /**
     * @return mixed
     */
    public function getDateToActivate() {
        return $this->dateToActivate;
    }

    /**
     * @param mixed $dateToActivate
     */
    public function setDateToActivate($dateToActivate) {
        $this->dateToActivate = $dateToActivate;
    }

    /**
     * @return mixed
     */
    public function getDateToShow() {
        return $this->dateToShow;
    }

    /**
     * @param mixed $dateToShow
     */
    public function setDateToShow($dateToShow) {
        $this->dateToShow = $dateToShow;
    }

    /**
     * @return mixed
     */
    public function getDateToStartOn() {
        return $this->dateToStartOn;
    }

    /**
     * @param mixed $dateToStartOn
     */
    public function setDateToStartOn($dateToStartOn) {
        $this->dateToStartOn = $dateToStartOn;
    }

    /**
     * @return mixed
     */
    public function getDateToSubmit() {
        return $this->dateToSubmit;
    }

    /**
     * @param mixed $dateToSubmit
     */
    public function setDateToSubmit($dateToSubmit) {
        $this->dateToSubmit = $dateToSubmit;
    }

    /**
     * @return mixed
     */
    public function getMaxAttempts() {
        return $this->maxAttempts;
    }

    /**
     * @param mixed $maxAttempts
     */
    public function setMaxAttempts($maxAttempts) {
        $this->maxAttempts = $maxAttempts;
    }

    /**
     * @return mixed
     */
    public function getMaxScore() {
        return $this->maxScore;
    }

    /**
     * @param mixed $maxScore
     */
    public function setMaxScore($maxScore) {
        $this->maxScore = $maxScore;
    }

    /**
     * @return mixed
     */
    public function getMaxSubmits() {
        return $this->maxSubmits;
    }

    /**
     * @param mixed $maxSubmits
     */
    public function setMaxSubmits($maxSubmits) {
        $this->maxSubmits = $maxSubmits;
    }
} 