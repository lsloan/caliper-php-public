<?php

/**
 *  author: Prashant Nayak
 *  ©2013 IMS Global Learning Consortium, Inc.  All Rights Reserved.
 *  For license information contact, info@imsglobal.org
 */
class CaliperEntity {

    private $id;
    private $type;
    private $lastModifiedAt;
    private $properties;

    /**
     * @param mixed $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $lastModifiedAt
     */
    public function setLastModifiedAt($lastModifiedAt) {
        $this->lastModifiedAt = $lastModifiedAt;
    }

    /**
     * @return mixed
     */
    public function getLastModifiedAt() {
        return $this->lastModifiedAt;
    }

    /**
     * @param mixed $properties
     */
    public function setProperties($properties) {
        $this->properties = $properties;
    }

    /**
     * @return mixed
     */
    public function getProperties() {
        return $this->properties;
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
} 