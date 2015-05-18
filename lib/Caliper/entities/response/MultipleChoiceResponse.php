<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/response/Response.php';
require_once 'Caliper/entities/response/ResponseType.php';
require_once 'util/BasicEnum.php';

class MultipleChoiceResponse extends Response {
    /**
     * @var string
     */
    private $value;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(ResponseType::MULTIPLECHOICE);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'value' => $this->getValue(),
        ]);
    }

    /**
     * @return string
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @param string $value
     * @return object
     */
    public function setValue($value) {
        $this->value = $value;
        return $this;
    }
}