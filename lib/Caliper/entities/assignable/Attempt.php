<?php
require_once dirname(__FILE__) . '/../CaliperEntity.php';
require_once 'Caliper/entities/EntityType.php';

class Attempt extends CaliperEntity implements JsonSerializable {

    private $assignable;
    private $actor;
    private $count;

    public function  __construct($id) {
        $this->setId($id);
        $this->setType(EntityType::ATTEMPT);
    }

    public function jsonSerialize() {
        return [
            '@id' => $this->getId(),
            '@type' => $this->getType(),
            'lastModifiedTime' => $this->getLastModifiedAt(),
            'properties' => (object) $this->getProperties(),
            'target' => $this->getTarget(),
            'assignable' => $this->getAssignable(),
            'actor' => $this->getActor(),
            'count' => $this->getCount(),
        ];
    }

    /**
     * @return mixed
     */
    public function getAssignable() {
        return $this->assignable;
    }

    /**
     * @param mixed $assignable
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
     */
    public function setActor($actor) {
        $this->actor = $actor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCount() {
        return $this->count;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count) {
        $this->count = $count;
        return $this;
    }
} 
