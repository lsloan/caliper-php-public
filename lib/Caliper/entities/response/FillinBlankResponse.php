<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/response/Response.php';
require_once 'Caliper/entities/response/ResponseType.php';
require_once 'util/BasicEnum.php';

class FillinBlankResponse extends Response {
    /** @var array */
    private $values;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(ResponseType::FILLINBLANK);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'values' => $this->getValues(),
        ]);
    }

    /** @return array */
    public function getValues() {
        return $this->values;
    }

    /**
     * @param array $values
     * @return $this|FillinBlankResponse
     */
    public function setValues($values) {
        if (!is_array($values)) {
            $values = [$values];
        }

        $this->values = $values;
        return $this;
    }
}