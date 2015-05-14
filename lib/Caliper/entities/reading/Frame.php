<?php
require_once 'Caliper/entities/CaliperDigitalResource.php';
require_once 'Caliper/entities/CaliperDigitalResourceTypes.php';

class Frame extends CaliperDigitalResource implements Targetable {
    private $index;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(CaliperDigitalResourceTypes::FRAME);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'index' => $this->getIndex(),
        ]);
    }

    /**
     * @return mixed
     */
    public function getIndex() {
        return $this->index;
    }

    /**
     * @param mixed $index
     * @return Frame
     */
    public function setIndex($index) {
        $this->index = $index;
        return $this;
    }
}
