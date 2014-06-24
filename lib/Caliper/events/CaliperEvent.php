<?php

/**
 *  author: Prashant Nayak
 *  ©2013 IMS Global Learning Consortium, Inc.  All Rights Reserved.
 *  For license information contact, info@imsglobal.org
 */
class CaliperEvent {

    private $context;
    private $type;
    private $action;
    private $agent;
    private $activityContext;
    private $learningContext;
    private $startedAt;

    /**
     * Create a new CaliperEvent
     */
    public function __construct() {
    }

    public function __destruct() {
    }

    /**
     * @param mixed $action
     */
    public function setAction($action) {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getAction() {
        return $this->action;
    }

    /**
     * @param mixed $activityContext
     */
    public function setActivityContext($activityContext) {
        $this->activityContext = $activityContext;
    }

    /**
     * @return mixed
     */
    public function getActivityContext() {
        return $this->activityContext;
    }

    /**
     * @param mixed $agent
     */
    public function setAgent($agent) {
        $this->agent = $agent;
    }

    /**
     * @return mixed
     */
    public function getAgent() {
        return $this->agent;
    }

    /**
     * @param mixed $context
     */
    public function setContext($context) {
        $this->context = $context;
    }

    /**
     * @return mixed
     */
    public function getContext() {
        return $this->context;
    }

    /**
     * @param mixed $startedAt
     */
    public function setStartedAt($startedAt) {
        $this->startedAt = $startedAt;
    }

    /**
     * @return mixed
     */
    public function getStartedAt() {
        return $this->startedAt;
    }

    /**
     * @param mixed $type
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param mixed $learningContext
     */
    public function setLearningContext($learningContext) {
        $this->learningContext = $learningContext;
    }

    /**
     * @return mixed
     */
    public function getLearningContext() {
        return $this->learningContext;
    }
}