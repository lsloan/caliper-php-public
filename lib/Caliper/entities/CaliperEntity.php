<?php
class CaliperEntity implements JsonSerializable {

    public $type;
    public $name;
    protected $id;
    private $lastModifiedAt = 0;
    private $properties;

    function __construct() {
    }

    /**
     * It is preferred to call NutritionalFacts::createBuilder
     * to calling this constructor directly.
     */
//    function __construct(CaliperEntityBuilder $b) {
//        $this->type = $b->getType();
//        $this->name = $b->getName();
//        $this->id = $b->getId();
//        $this->lastModifiedAt = $b->getLastModifiedAt();
//        $this->properties = $b->getProperties();
//    }
//
//    static function builder($s) {
//        return new CaliperEntityBuilder();
//    }

    /**
     ** @see JsonSerializable::jsonSerialize()
     *to implement jsonLD
     */
    public function jsonSerialize() {

        return ['@id' => $this->getId(),
            '@type' => $this->getType(),
            'name' => $this->getName(),
            'properties'=>(object) $this->getProperties(),
            'lastModifiedTime' => $this->getLastModifiedAt()
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
     * @return int
     */
    public function getLastModifiedAt() {
        return $this->lastModifiedAt;
    }

    /**
     * @param int $lastModifiedAt
     */
    public function setLastModifiedAt($lastModifiedAt) {
        $this->lastModifiedAt = $lastModifiedAt;
    }


    /**
     * @return mixed
     */
    public function getProperties() {
        return $this->properties;
    }

    /**
     * @param mixed $properties
     */
    public function setProperties($properties) {
        $this->properties = $properties;
    }
} 