<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/Entity.php';
require_once 'Caliper/entities/EntityType.php';
require_once 'Caliper/entities/Generatable.php';

class Result extends Entity implements Generatable {
    private $assignable;
    private $actor;
    private $normalScore;
    private $penaltyScore;
    private $extraCreditScore;
    private $totalScore;
    private $curvedTotalScore;
    private $curveFactor;
    private $comment;
    private $scoredBy;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(EntityType::RESULT);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'assignable' => $this->getAssignable(),
            'actor' => $this->getActor(),
            'normalScore' => $this->getNormalScore(),
            'penaltyScore' => $this->getPenaltyScore(),
            'extraCreditScore' => $this->getExtraCreditScore(),
            'totalScore' => $this->getTotalScore(),
            'curvedTotalScore' => $this->getCurvedTotalScore(),
            'curveFactor' => $this->getCurveFactor(),
            'comment' => $this->getComment(),
            'scoredBy' => $this->getScoredBy(),
        ]);
    }

    /**
     * @return mixed
     */
    public function getAssignable() {
        return $this->assignable;
    }

    /**
     * @param mixed $assignable
     * @return object
     */
    public function setAssignable($assignable) {
        $this->assignable = $assignable;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getActor() {
        return $this->actor;
    }

    /**
     * @param mixed $actor
     * @return object
     */
    public function setActor($actor) {
        $this->actor = $actor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNormalScore() {
        return $this->normalScore;
    }

    /**
     * @param mixed $normalScore
     * @return object
     */
    public function setNormalScore($normalScore) {
        $this->normalScore = $normalScore;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPenaltyScore() {
        return $this->penaltyScore;
    }

    /**
     * @param mixed $penaltyScore
     * @return object
     */
    public function setPenaltyScore($penaltyScore) {
        $this->penaltyScore = $penaltyScore;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExtraCreditScore() {
        return $this->extraCreditScore;
    }

    /**
     * @param mixed $extraCreditScore
     * @return object
     */
    public function setExtraCreditScore($extraCreditScore) {
        $this->extraCreditScore = $extraCreditScore;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalScore() {
        return $this->totalScore;
    }

    /**
     * @param mixed $totalScore
     * @return object
     */
    public function setTotalScore($totalScore) {
        $this->totalScore = $totalScore;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurvedTotalScore() {
        return $this->curvedTotalScore;
    }

    /**
     * @param mixed $curvedTotalScore
     * @return object
     */
    public function setCurvedTotalScore($curvedTotalScore) {
        $this->curvedTotalScore = $curvedTotalScore;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurveFactor() {
        return $this->curveFactor;
    }

    /**
     * @param mixed $curveFactor
     * @return object
     */
    public function setCurveFactor($curveFactor) {
        $this->curveFactor = $curveFactor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComment() {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     * @return object
     */
    public function setComment($comment) {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getScoredBy() {
        return $this->scoredBy;
    }

    /**
     * @param mixed $scoredBy
     * @return object
     */
    public function setScoredBy($scoredBy) {
        $this->scoredBy = $scoredBy;
        return $this;
    }
}
