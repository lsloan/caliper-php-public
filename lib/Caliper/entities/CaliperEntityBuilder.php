<?php

/**
 * Created by PhpStorm.
 * User: pnayak
 * Date: 10/21/14
 * Time: 1:53 PM
 */
class CaliperEntityBuilder {

    public $type;
    public $name;
    protected $id;
    private $lastModifiedAt = 0;
    private $properties;

    /**
     * It is preferred to call CaliperEntity::builder
     * to calling this constructor directly.
     */
    function __construct() {
    }

    function type($t) {
        $this->type = $t;
        return $this;
    }

    function name($t) {
        $this->name = $t;
        return $this;
    }

    function id($t) {
        $this->id = $t;
        return $this;
    }

    function lastModifiedAt($t) {
        $this->lastModifiedAt = $t;
        return $this;
    }

    function properties($t) {
        $this->properties = $t;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getLastModifiedAt() {
        return $this->lastModifiedAt;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getProperties() {
        return $this->properties;
    }

    /**
     * @return mixed
     */
    public function getType() {
        return $this->type;
    }

    function build() {
        return new CaliperEntity($this);
    }
} 