<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/assignable/Assignable.php';
require_once 'Caliper/entities/DigitalResource.php';
require_once 'Caliper/entities/DigitalResourceType.php';
require_once 'util/TimestampUtil.php';

class AssignableDigitalResource extends DigitalResource implements Assignable {
    /** @var  DateTime */
    private $dateToActivate;
    /** @var  DateTime */
    private $dateToShow;
    /** @var  DateTime */
    private $dateToStartOn;
    /** @var  DateTime */
    private $dateToSubmit;
    /** @var  int */
    private $maxAttempts;
    /** @var  int */
    private $maxSubmits;
    /** @var  float */
    private $maxScore;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new DigitalResourceType(DigitalResourceType::ASSIGNABLE_DIGITAL_RESOURCE));
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'dateToActivate' => TimestampUtil::formatTimeISO8601MillisUTC($this->getDateToActivate()),
            'dateToShow' => TimestampUtil::formatTimeISO8601MillisUTC($this->getDateToShow()),
            'dateToStartOn' => TimestampUtil::formatTimeISO8601MillisUTC($this->getDateToStartOn()),
            'dateToSubmit' => TimestampUtil::formatTimeISO8601MillisUTC($this->getDateToSubmit()),
            'maxAttempts' => $this->getMaxAttempts(),
            'maxSubmits' => $this->getMaxSubmits(),
            'maxScore' => $this->getMaxScore(),
        ]);
    }

    /** @return DateTime dateToActivate */
    public function getDateToActivate() {
        return $this->dateToActivate;
    }

    /**
     * @param DateTime $dateToActivate
     * @return $this|AssignableDigitalResource
     */
    public function setDateToActivate(DateTime $dateToActivate) {
        $this->dateToActivate = $dateToActivate;
        return $this;
    }

    /** @return DateTime dateToShow */
    public function getDateToShow() {
        return $this->dateToShow;
    }

    /**
     * @param DateTime $dateToShow
     * @return $this|AssignableDigitalResource
     */
    public function setDateToShow(DateTime $dateToShow) {
        $this->dateToShow = $dateToShow;
        return $this;
    }

    /** @return DateTime dateToStartOn */
    public function getDateToStartOn() {
        return $this->dateToStartOn;
    }

    /**
     * @param DateTime $dateToStartOn
     * @return $this|AssignableDigitalResource
     */
    public function setDateToStartOn(DateTime $dateToStartOn) {
        $this->dateToStartOn = $dateToStartOn;
        return $this;
    }

    /** @return DateTime dateToSubmit */
    public function getDateToSubmit() {
        return $this->dateToSubmit;
    }

    /**
     * @param DateTime $dateToSubmit
     * @return $this|AssignableDigitalResource
     */
    public function setDateToSubmit(DateTime $dateToSubmit) {
        $this->dateToSubmit = $dateToSubmit;
        return $this;
    }

    /** @return int maxAttempts */
    public function getMaxAttempts() {
        return $this->maxAttempts;
    }

    /**
     * @param int $maxAttempts
     * @return $this|AssignableDigitalResource
     */
    public function setMaxAttempts($maxAttempts) {
        $this->maxAttempts = $maxAttempts;
        return $this;
    }

    /** @return int maxSubmits */
    public function getMaxSubmits() {
        return $this->maxSubmits;
    }

    /**
     * @param int $maxSubmits
     * @return $this|AssignableDigitalResource
     */
    public function setMaxSubmits($maxSubmits) {
        $this->maxSubmits = $maxSubmits;
        return $this;
    }

    /** @return float maxScore */
    public function getMaxScore() {
        return $this->maxScore;
    }

    /**
     * @param float $maxScore
     * @return $this|AssignableDigitalResource
     */
    public function setMaxScore($maxScore) {
        $this->maxScore = $maxScore;
        return $this;
    }
} 
