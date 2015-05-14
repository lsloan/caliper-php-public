<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/schemadotorg/Thing.php';
require_once 'util/TimestampUtil.php';

class CaliperEntity implements JsonSerializable, Thing {

    protected $id;
    public $type;
    public $name;
    private $description;
    private $extensions;
    private $dateCreated;
    private $dateModified;

    function __construct($id) {
        $this->setId($id);
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
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setDescription($value) {
        $this->description = $value;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
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
    }
    
    /**
     * @return int
     */
    public function getDateCreated() {
        return $this->dateCreated;
    }

    /**
     * @param int $dateCreated
     */
    public function setDateCreated($dateCreated) {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return int
     */
    public function getDateModified() {
        return $this->dateModified;
    }

    /**
     * @param int $dateModified
     */
    public function setDateModified($dateModified) {
        $this->dateModified = $dateModified;
    }
} 