<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/schemadotorg/Thing.php';
require_once 'util/TimestampUtil.php';

class CaliperEntity implements JsonSerializable, Thing {

    public $type;
    public $name;
    protected $id;
    private $description;
    private $extensions;
    private $dateCreated;
    private $dateModified;

    function __construct() {
    }

    public function jsonSerialize() {
        return [
            '@id' => $this->getId(),
            '@type' => $this->getType(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'extensions' => (object) $this->getExtensions(),
            'dateCreated' => TimestampUtil::formatTimeISO8601MillisUTC($this->getDateCreated()),
            'dateModified' => TimestampUtil::formatTimeISO8601MillisUTC($this->getDateModified()),
        ];
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return $this
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExtensions() {
        return $this->extensions;
    }

    /**
     * @param mixed $extensions
     */
    public function setExtensions($extensions) {
        $this->extensions = $extensions;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateCreated() {
        return $this->dateCreated;
    }

    /**
     * @param DateTime $dateCreated
     */
    public function setDateCreated($dateCreated) {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateModified() {
        return $this->dateModified;
    }

    /**
     * @param DateTime $dateModified
     */
    public function setDateModified($dateModified) {
        $this->dateModified = $dateModified;
        return $this;
    }
} 
