<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/response/Response.php';
require_once 'Caliper/entities/response/ResponseType.php';
require_once 'util/BasicEnum.php';

class MultipleResponseResponse extends Response {
    /** @var string[] */
    private $values;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new ResponseType(ResponseType::MULTIPLERESPONSE));
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'values' => $this->getValues(),
        ]);
    }

    /** @return string[] values */
    public function getValues() {
        return $this->values;
    }

    /**
     * @param string[] $values
     * @return $this|MultipleResponseResponse
     */
    public function setValues($values) {
        if (!is_array($values)) {
            $values = [$values];
        }

        $this->values = $values;
        return $this;
    }
}